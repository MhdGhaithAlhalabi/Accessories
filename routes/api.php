<?php

use App\Http\Controllers\Api\Customer\AuthController;
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

Route::group(['prefix' => 'customer','namespace'=>'Customer'],function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:customer-api']);
});
Route::group(['prefix' => 'customer','namespace'=>'Customer'],function () {
///////////////////////////////flutter api////////////////////////////////
//FEEDBACK CONTROLLER
    Route::post('/feedbackStore', [FeedbackController::class, 'store'])->middleware(['auth:customer-api']);//flutter
//CUSTOMER CONTROLLER
    Route::get('/menu', [CustomerController::class, 'menu'])->middleware(['auth:customer-api']);//flutter
//ORDER CONTROLLER
    Route::post('/orderStore', [OrderController::class, 'Store'])->middleware(['auth:customer-api']);//flutter
//CART CONTROLLER
    Route::get('/orderCustomerView/{customer_id}', [CartController::class, 'index2']);//flutter
//RATE CONTROLLER
    Route::get('/rateView/{id}', [RateController::class, 'show'])->middleware(['auth:customer-api']);//flutter
    Route::post('/rateStore', [RateController::class, 'store'])->middleware(['auth:customer-api']);//flutter
});
