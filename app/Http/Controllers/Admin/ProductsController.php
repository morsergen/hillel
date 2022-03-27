<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\FileUploadService;
use App\Services\ImageService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Throwable;

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
    public function create(): View|Factory|Application
    {
        $categories = Category::all();

        return view('admin/product/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $storeProductRequest
     * @param ImageService $imageService
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     * @throws Throwable
     */
    public function store(StoreProductRequest $storeProductRequest, ImageService $imageService): Redirector|RedirectResponse|Application
    {
        $validatedData = $storeProductRequest->validated();

        $images = $validatedData['images'] ?? [];

        $category = Category::find($validatedData['category_id']);

        \DB::transaction(function() use ($imageService, $validatedData, $images, $category) {
            $product = $category->products()->create(
                array_merge($validatedData, ['slug' => \Str::slug($validatedData['title'])])
            );
            $imageService->attach($product, 'images', $images);
        }, 5);

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
     * @param ImageService $imageService
     * @return Application|Redirector|RedirectResponse
     * @throws Throwable
     */
    public function update(UpdateProductRequest $updateProductRequest, Product $product, ImageService $imageService): Redirector|RedirectResponse|Application
    {
        $validatedData = $updateProductRequest->validated();

        $images = $validatedData['images'] ?? [];

        \DB::transaction(function() use ($imageService, $validatedData, $images, $product) {
            $product->update(
                array_merge($validatedData, ['slug' => \Str::slug($validatedData['title'])])
            );
            $imageService->attach($product, 'images', $images);
        }, 5);

        return redirect(route('admin.products.index'))->with('success', __('Product updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @param ImageService $imageService
     * @return Application|Redirector|RedirectResponse
     * @throws Exception
     * @throws Throwable
     */
    public function destroy(Product $product, ImageService $imageService): Redirector|RedirectResponse|Application
    {
        \DB::transaction(function() use ($imageService, $product) {
            $imageService->detach($product, 'images');
            FileUploadService::remove($product->thumbnail);
            $product->delete();
        }, 5);

        return redirect(route('admin.products.index'))->with('success', __('Product deleted successfully'));
    }
}
