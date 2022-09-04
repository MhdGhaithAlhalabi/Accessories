<?php

use App\Http\Controllers\Api\Customer\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Api\Customer\CustomerController;
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
    Route::post('editProfile', [AuthController::class, 'editProfile'])->middleware(['auth:customer-api']);

});


///////////////////////////////customer api////////////////////////////////
Route::group(['prefix' => 'customer','namespace'=>'Customer','middleware'=>'auth:customer-api'],function () {
///////////////////////////////flutter api////////////////////////////////
    //Api \ Customer \ CustomerController
    Route::post('/feedbackStore', [CustomerController::class, 'feedbackStore']);//flutter
    Route::get('/menu', [CustomerController::class, 'menu']);//flutter
    Route::post('/orderStore', [CustomerController::class, 'orderStore']);//flutter
    Route::get('/orderCustomerView/{customer_id}', [CustomerController::class, 'orderCustomerView']);//flutter
    Route::post('/rateStore', [CustomerController::class, 'rateStore']);//flutter
    Route::get('/typeView', [CustomerController::class, 'typeView']);//flutter
    Route::get('/categoryView/{id}', [CustomerController::class, 'categoryView']);//flutter
    Route::get('/productView/{type_id}/{category_id}', [CustomerController::class, 'productView']);//flutter
    Route::get('/offerView', [CustomerController::class, 'offerView']);//flutter
    Route::post('/searchByName', [CustomerController::class, 'searchByName']);//flutter

});
