<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', AuthController::class)->middleware(['middleware' => 'throttle:10,1']);

Route::middleware(['api', 'auth:sanctum', 'api_version:v1'])->prefix('v1')->name('api.')->group(function(){
    require_once base_path('routes/api/v1.php');
});

Route::middleware(['api', 'auth:sanctum', 'api_version:v2'])->prefix('v2')->name('api.')->group(function(){
    require_once base_path('routes/api/v2.php');
});

Route::middleware(['api', 'auth:sanctum', 'admin', 'api_version:v2'])->prefix('admin/v2')->name('api.admin.')->group(function(){
    require_once base_path('routes/api/admin/v2.php');
});
