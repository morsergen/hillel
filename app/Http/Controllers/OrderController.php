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
    public function thankYouPage(Order $order)
    {
        return view('pages.thank-you-page', compact('order'));
    }

    public function errorPage()
    {
        return view('pages.error-page');
    }
}
