<?php

use App\Http\Controllers\Api\Customer\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\TypeController;
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



///////////////////////////////customer auth////////////////////////////////
Route::group(['prefix' => 'customer','namespace'=>'Customer'],function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:customer-api']);
});


///////////////////////////////customer api////////////////////////////////
Route::group(['prefix' => 'customer','namespace'=>'Customer','middleware'=>'auth:customer-api'],function () {
///////////////////////////////flutter api////////////////////////////////
//FEEDBACK CONTROLLER
    Route::post('/feedbackStore', [FeedbackController::class, 'store']);//flutter
//CUSTOMER CONTROLLER
    Route::get('/menu', [CustomerController::class, 'menu']);//flutter
//ORDER CONTROLLER
    Route::post('/orderStore', [OrderController::class, 'Store']);//flutter
//CART CONTROLLER
    Route::get('/orderCustomerView/{customer_id}', [CartController::class, 'index2']);//flutter
//RATE CONTROLLER
    Route::get('/rateView/{id}', [RateController::class, 'show']);//flutter
    Route::post('/rateStore', [RateController::class, 'store']);//flutter
//TYPE CONTROLLER
    Route::get('/typeView', [TypeController::class, 'typeView']);//flutter
    Route::get('/categoryView/{id}', [TypeController::class, 'categoryView']);//flutter
    Route::get('/productView/{type_id}/{category_id}', [TypeController::class, 'productView']);//flutter
    Route::get('/offerView', [TypeController::class, 'offerView']);//flutter
    Route::post('/searchByName', [TypeController::class, 'searchByName']);//flutter

});
