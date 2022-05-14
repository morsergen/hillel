<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Api\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Throwable;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(Product::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $storeProductRequest
     * @return ProductResource
     * @throws Throwable
     */
    public function store(StoreProductRequest $storeProductRequest): ProductResource
    {
        $validatedData = $storeProductRequest->validated();
        $category = Category::find($validatedData['category_id']);
        $product = \DB::transaction(function() use ($validatedData, $category) {
            return $category->products()->create(
                array_merge($validatedData, ['slug' => \Str::slug($validatedData['title'])])
            );
        }, 5);
        return ProductResource::make($product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $updateProductRequest
     * @param Product $product
     * @return ProductResource
     * @throws Throwable
     */
    public function update(UpdateProductRequest $updateProductRequest, Product $product): ProductResource
    {
        $validatedData = $updateProductRequest->validated();
        $product = \DB::transaction(function() use ($validatedData, $product) {
            $product->update(
                array_merge($validatedData, ['slug' => \Str::slug($validatedData['title'])])
            );
        }, 5);
        return ProductResource::make($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     * @throws Throwable
     */
    public function destroy(Product $product): Response
    {
        $product->delete();
        return response()->noContent();
    }
}
