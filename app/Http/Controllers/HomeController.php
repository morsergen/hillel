<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /***
     * @return Renderable
     */
    public function index(): Renderable
    {
        $categories = Category::with('products')->get();
        return view('home', compact('categories'));
    }
}
