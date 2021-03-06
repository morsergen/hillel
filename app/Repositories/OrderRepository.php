<?php

namespace App\Repositories;

use App\Models\OrderStatus;
use App\Models\Transaction;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Models\Order;
use Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $requestData): Order
    {
        return \DB::transaction(function () use ($requestData) {
            $order = Auth::user()->orders()->create($requestData);

            foreach (Cart::instance('cart')->content() as $cartItem) {
                if ($cartItem->model->in_stock < $cartItem->qty) {
                    throw new \Exception('Something went wrong');
                }
                $order->products()->attach($cartItem->model, [
                    'quantity' => $cartItem->qty,
                    'single_price' => $cartItem->price
                ]);
                $cartItem->model->decrement('in_stock', (int)$cartItem->qty);
            }

            return $order;
        });
    }

    public function cancel(Order $order)
    {
        if ($order->is_paid) {
            $order->user->increment('balance', $order->total);
        }

        foreach ($order->products as $product) {
            $product->increment('in_stock', $product->pivot->quantity);
        }

        $order->update([
            'status_id' => OrderStatus::whereName(OrderStatus::STATUS_CANCELLED)->first()->id
        ]);
    }

    public function checkResult($result)
    {
        $data = null;

        if ($result['status'] === Transaction::STATUS_COMPLETED) {
            $order = Order::whereVendorOrderId($result['id'])->firstOrFail();
            $order->update(['transaction_id' => $result["purchase_units"][0]["payments"]["captures"][0]["id"]]);
            $order->status()->associate(OrderStatus::whereName(OrderStatus::STATUS_COMPLETED)->first())->save();
            Cart::instance('cart')->destroy();
            $data = $order->id;
        }

        return $data;
    }
}
