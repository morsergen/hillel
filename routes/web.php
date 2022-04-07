<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Ajax\DeleteImageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function(){
    Route::get('/', DashBoardController::class)->name('home');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductsController::class);
    Route::resource('/users', UsersController::class);
});

Route::delete('ajax/image/{image}', DeleteImageController::class)->name('ajax.image.delete');

Route::get('/category/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
Route::get('/product/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/{product}', [CartController::class, 'add'])->name('add');
    Route::put('/{product}', [CartController::class, 'update'])->name('update');
    Route::delete('/', [CartController::class, 'delete'])->name('delete');
});

Route::prefix('account')->name('account.')->middleware(['auth'])->group(function() {
    Route::get('/', [App\Http\Controllers\Account\UserController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\Account\UserController::class, 'edit'])->name('edit');
    Route::put('update', [App\Http\Controllers\Account\UserController::class, 'update'])->name('update');

    Route::get('{user}/edit', [App\Http\Controllers\Account\UserController::class, 'editByUser'])
        ->can('view', 'user')
        ->name('editByUser');

    Route::get('wish-list', App\Http\Controllers\Account\WishListController::class)->name('wish-list');
});

Route::middleware(['auth'])->group(function() {
    Route::get('checkout', CheckoutController::class)->name('checkout');
    Route::post('order', [OrderController::class, 'create'])->name('order.create');
    Route::get('thank-you-page/{order}', [OrderController::class, 'thankYouPage'])
        ->can('view', 'order')
        ->name('thank-you-page');
    Route::get('error-page', [OrderController::class, 'errorPage'])->name('error-page');

    Route::get('wishlist/{product}/add', [WishListController::class, 'add'])->name('wishlist.add');
    Route::delete('wishlist/{product}/delete', [WishListController::class, 'delete'])->name('wishlist.delete');
});
