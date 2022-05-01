<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Models\OrderStatus;
use App\Models\Transaction;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\Contracts\PayPalServiceInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalPaymentController extends Controller
{
    public function __construct(private PayPalClient $payPalClient)
    {
        $this->payPalClient->setApiCredentials(config('paypal'));
        $this->payPalClient->getAccessToken();
    }

    public function create(CreateOrderRequest $createOrderRequest, OrderRepositoryInterface $orderRepository, PayPalServiceInterface $palService)
    {
        $cart = Cart::instance('cart');
        $paypalOrder = $this->payPalClient->createOrder(
            $palService->getDataForCreateOrder($cart->total)
        );
        $order = $orderRepository->create(
            array_merge(
                $createOrderRequest->validated(),
                [
                    'vendor_order_id' => $paypalOrder['id'],
                    'status_id' => OrderStatus::whereName(OrderStatus::STATUS_IN_PROGRESS)->first()->id,
                    'total' => $cart->total,
                ]
            )
        );

        return response()->json($order);
    }

    public function capture(string $orderId, OrderRepositoryInterface $orderRepository)
    {
        \DB::beginTransaction();
        try {
            $result = $this->payPalClient->capturePaymentOrder($orderId);
            $orderRepository->checkResult($result);
            \DB::commit();
            return response()->json($result);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
