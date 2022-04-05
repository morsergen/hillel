<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function create(CreateOrderRequest $createOrderRequest, OrderRepositoryInterface $repository)
    {
        $cart= Cart::instance('cart');
        if ($cart->total > Auth::user()->balance) {
            return redirect()->back()->withInput()->with('warning', __('There won\'t be enough money'));
        }

        try {
            $order = $repository->create(
                array_merge(
                    $createOrderRequest->validated(),
                    [
                        'status_id' => OrderStatus::whereName(OrderStatus::STATUS_IN_PROGRESS)->first()->id,
                        'total' => $cart->total
                    ]
                )
            );
            $cart->destroy();
            $order->status()->associate(OrderStatus::whereName(OrderStatus::STATUS_COMPLETED)->first())->save();
            return redirect()->route('thank-you-page', $order);
        } catch (\Exception $error) {
            logs()->error($error);
            return redirect()->route('error-page');
        }
    }

    public function thankYouPage(Order $order)
    {
        return view('pages.thank-you-page', compact('order'));
    }

    public function errorPage()
    {
        return view('pages.error-page');
    }
}
