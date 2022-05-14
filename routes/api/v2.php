<?php

use App\Http\Controllers\Api\V2\ProductsController;

Route::resource('products', ProductsController::class)->only(['index', 'show']);
