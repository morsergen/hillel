<?php

namespace App\Repositories;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Models\Order;
use Auth;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $requestData): Order
    {
        $order = Auth::user()->orders()->create($requestData);

        foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content() as $cartItem) {
            $order->products()->save($cartItem->model, [
                'quantity' => $cartItem->qty,
                'single_price' => $cartItem->price
            ]);
        }

        return $order;
    }
}
