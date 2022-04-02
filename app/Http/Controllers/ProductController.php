<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;

class ProductController extends Controller
{
    /***
     * @return Renderable
     */
    public function show(Product $product): Renderable
    {
        return view('products.show', compact('product'));
    }
}
