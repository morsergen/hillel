<?php

namespace App\Repositories;

use App\Models\OrderStatus;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Models\Order;
use Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $requestData): Order
    {
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
}
