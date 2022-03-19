<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $categories = Category::withCount('products')->paginate();
        return view('admin/category/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin/category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $storeCategoryRequest
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreCategoryRequest $storeCategoryRequest): Redirector|RedirectResponse|Application
    {
        $validatedData = $storeCategoryRequest->validated();
        Category::create(
            array_merge($validatedData, ['slug' => \Str::slug($validatedData['name'])])
        );
        return redirect(route('admin.categories.index'))->with('success', __('Category created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function show(Category $category): View|Factory|Application
    {
        return view('admin/category/show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category): View|Factory|Application
    {
        return view('admin/category/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $updateCategoryRequest
     * @param Category $category
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateCategoryRequest $updateCategoryRequest, Category $category): Redirector|RedirectResponse|Application
    {
        $validatedData = $updateCategoryRequest->validated();
        $category->update(
            array_merge($validatedData, ['slug' => \Str::slug($validatedData['name'])])
        );
        return redirect(route('admin.categories.index'))->with('success', __('Category updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Category $category): Redirector|Application|RedirectResponse
    {
        $category->delete();
        return redirect(route('admin.categories.index'))->with('success', __('Category deleted successfully'));
    }
}
