<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\RemoveFromCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart/index');
    }

    public function add(AddToCartRequest $addToCartRequest, Product $product)
    {
        $validatedData = $addToCartRequest->validated();

        $cartItem = Cart::instance('cart')->add(
            $product->id,
            $product->title,
            $validatedData['product_count'],
            $product->end_price
        )->associate(Product::class);

        return redirect()->back()->with('success', __('Product added to cart successfully'));
    }

    public function update(UpdateCartRequest $updateCartRequest, Product $product)
    {
        $validatedData = $updateCartRequest->validated();
        Cart::instance('cart')->update(
            $validatedData['row_id'],
            $validatedData['product_count'],
        );
        return redirect()->back();
    }

    public function delete(RemoveFromCartRequest $removeFromCartRequest)
    {
        $validatedData = $removeFromCartRequest->validated();
        Cart::instance('cart')->remove($validatedData['row_id']);
        return redirect()->back()->with('success', __('Product successfully removed from cart'));
    }
}
