<?php

use App\Http\Controllers\Api\Admin\ProductsController;

Route::resource('products', ProductsController::class)->except(['create', 'edit']);
