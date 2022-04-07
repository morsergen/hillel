<?php

namespace App\Repositories;

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
}
