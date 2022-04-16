<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessOrderCancelJob;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->orderByDesc('id')->paginate(5);

        return view('account/orders/index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('account/orders/show', compact('order'));
    }

    public function cancel(Order $order, OrderRepositoryInterface $repository)
    {
        if ($order->is_canceled || $order->is_completed) {
            return redirect()->back()->withErrors(['Order already completed or canceled']);
        }

        \DB::transaction(function() use ($repository, $order) {
            ProcessOrderCancelJob::dispatch($order);
        }, 5);

        return redirect()->back()->with('success', 'Order canceled');
    }
}
