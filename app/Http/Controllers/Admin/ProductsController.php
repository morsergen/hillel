<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $products = Product::with('category')->paginate();
        return view('admin/product/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin/product/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $storeProductRequest
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreProductRequest $storeProductRequest)
    {
        $validatedData = $storeProductRequest->validated();

        $category = Category::find($validatedData['category_id']);

        $category->products()->create(
            array_merge($validatedData, ['slug' => \Str::slug($validatedData['title'])])
        );

        return redirect(route('admin.products.index'))->with('success', __('Product created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function show(Product $product): View|Factory|Application
    {
        return view('admin/product/show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product): View|Factory|Application
    {
        $categories = Category::all();
        return view('admin/product/edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $updateProductRequest
     * @param Product $product
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateProductRequest $updateProductRequest, Product $product)
    {
        $validatedData = $updateProductRequest->validated();

        $product->update(
            array_merge($validatedData, ['slug' => \Str::slug($validatedData['title'])])
        );

        return redirect(route('admin.products.index'))->with('success', __('Product updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('admin.products.index'))->with('success', __('Product deleted successfully'));
    }
}
