<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;

class CategoryController extends Controller
{
    /***
     * @param Category $category
     * @return Renderable
     */
    public function show(Category $category): Renderable
    {
        $products = Product::whereCategoryId($category->id)->paginate();
        return view('categories.show', compact('category', 'products'));
    }
}
