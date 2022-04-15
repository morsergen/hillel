<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'status'])->orderByDesc('id')->paginate(5);

        return view('admin/orders/index', compact('orders'));
    }

    public function edit(Order $order)
    {
        $statuses = OrderStatus::all();

        return view('admin/orders/edit', compact('order', 'statuses'));
    }

    public function update(UpdateOrderRequest $updateOrderRequest, Order $order)
    {
        $order->update($updateOrderRequest->validated());

        return redirect()->back()->with('success', 'Order updated');
    }
}
