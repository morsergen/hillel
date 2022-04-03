<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Ajax\DeleteImageController;
use App\Http\Controllers\CartController;
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
    Route::get('/edit', [App\Http\Controllers\Account\UserController::class, 'edit'])->name('edit');
    Route::put('/update', [App\Http\Controllers\Account\UserController::class, 'update'])->name('update');
});
