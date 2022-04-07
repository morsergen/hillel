<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Auth;

class WishListController extends Controller
{
    public function add(Product $product)
    {
        Auth::user()->wishes()->attach($product);
        return redirect()->back()->with('success', __('Product added to wish list'));
    }

    public function delete(Product $product)
    {
        Auth::user()->wishes()->detach($product);
        return redirect()->back()->with('success', __('Product deleted from wish list'));
    }
}
