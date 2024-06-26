<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/restaurants', [ApiController::class, 'index']);
Route::get('/types', [ApiController::class, 'getRestaurantTypes']);
Route::get('/filter', [ApiController::class, 'getRestaurantsByTypes']);
Route::get('/restaurant-detail/{slug}', [ApiController::class, 'getReustarantDetail']);

// Rotte ordini
Route::get('orders/generate', [OrderController::class, 'generate']);
Route::get('orders/get', [OrderController::class, 'store']);
