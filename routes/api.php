<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RateController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
///////////////////////////////flutter api////////////////////////////////
//CUSTOMER CONTROLLER
Route::post('/customerStore', [CustomerController::class, 'Store']);//flutter
//ORDER CONTROLLER
Route::post('/orderStore', [OrderController::class, 'Store']);//flutter
//CART CONTROLLER
Route::get('/orderCustomerView/{customer_id}', [CartController::class, 'index2']);//flutter
//FEEDBACK CONTROLLER
Route::post('/feedbackStore', [FeedbackController::class, 'store']);//flutter
//RATE CONTROLLER
Route::get('/rateView/{id}', [RateController::class, 'show']);//flutter
Route::post('/rateStore', [RateController::class, 'store']);//flutter
