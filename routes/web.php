<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\TypeController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard',[ProductController::class, 'dashboardIndex'] )->name('dashboard');
Route::get('/getMessage',[ProductController::class, 'getMessage'])->name('getMessage');
    Route::get('/getCart',[ProductController::class, 'getCart'])->name('getCart');


    Route::get('/product', function () {
        return view('product.product');
    });
    Route::get('/feedback', function () {
        return view('feedback.feedback');
    });
    Route::get('/menu', function () {
        return view('menu.menu');
    });


});

Route::middleware(['auth'])->group(function () {
    Route::get('/findTypeByName',[TypeController::class, 'findTypeByName'] )->name('findTypeByName');
    //TYPE CONTROLLER
    Route::get('/typeView',[TypeController::class, 'index'] )->name('type.index');
    Route::get('/typeCreate',[TypeController::class, 'create'] )->name('type.create');
    Route::post('/typeStore', [TypeController::class, 'store'])->name('type.store');
    Route::get('/typeEdit/{type}', [TypeController::class, 'edit'])->name('type.edit');
    Route::post('/typeEdit/{type}', [TypeController::class, 'update'])->name('type.update');
    Route::delete('/typeDelete/{type}', [TypeController::class, 'destroy'])->name('type.delete');
    //Category CONTROLLER
    Route::get('/categoryView',[CategoryController::class, 'index'] )->name('category.index');
    Route::get('/categoryCreate',[CategoryController::class, 'create'] )->name('category.create');
    Route::post('/categoryStore', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categoryEdit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/categoryEdit/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categoryDelete/{category}', [CategoryController::class, 'destroy'])->name('category.delete');
    //PRODUCT CONTROLLER
    Route::get('/productView', [ProductController::class, 'index'])->name('product.index');
    Route::get('/productView2', [ProductController::class, 'index2'])->name('product.index2');
    Route::get('/productCreate',[ProductController::class, 'create'] )->name('product.create');
    Route::post('/productStore', [ProductController::class, 'store'])->name('product.store');
    Route::get('/productEdit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/productEdit/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/productDelete/{product}', [ProductController::class, 'destroy'])->name('product.delete');
    //Image CONTROLLER
    Route::get('/imageView', [ImageController::class, 'index'])->name('image.index');
    Route::get('/imageCreate',[ImageController::class, 'create'] )->name('image.create');
    Route::post('/imageStore', [ImageController::class, 'store'])->name('image.store');
    Route::get('/imageEdit/{image}', [ImageController::class, 'edit'])->name('image.edit');
    Route::post('/imageEdit/{image}', [ImageController::class, 'update'])->name('image.update');
    Route::delete('/imageDelete/{image}', [ImageController::class, 'destroy'])->name('image.delete');
    //Color CONTROLLER
    Route::get('/colorView', [ColorController::class, 'index'])->name('color.index');
    Route::get('/colorCreate',[ColorController::class, 'create'] )->name('color.create');
    Route::post('/colorStore', [ColorController::class, 'store'])->name('color.store');
    Route::get('/colorEdit/{color}', [ColorController::class, 'edit'])->name('color.edit');
    Route::post('/colorEdit/{color}', [ColorController::class, 'update'])->name('color.update');
    Route::delete('/colorDelete/{color}', [ColorController::class, 'destroy'])->name('color.delete');
    //MENU CONTROLLER
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::post('/menuStore', [MenuController::class, 'store'])->name('menu.store');
    Route::delete('/menuDelete/{menu}', [MenuController::class, 'destroy'])->name('menu.delete');
    //CUSTOMER CONTROLLER
    Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
    Route::delete('/customerDelete/{customer}', [CustomerController::class, 'destroy'])->name('customer.delete');


    //CART CONTROLLER
    Route::get('/cartView', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cartView/{cart}', [CartController::class, 'cartView'])->name('cart.cartView');
    Route::post('/cartDone/{cart}', [CartController::class, 'cartDone'])->name('cart.done');
    Route::delete('/cartDelete/{cart}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::get('/ondel', [CartController::class, 'ondel'])->name('cart.ondel');

    //Route::get('/cartDoneView', [CartController::class, 'cartDoneView'])->name('cart.done.index');
    Route::get('/monthlyReport', [CartController::class, 'monthlyReport'])->name('monthlyReport');
    Route::get('/dailyReport', [CartController::class, 'dailyReport'])->name('dailyReport');
    //RATE CONTROLLER
    Route::get('/rateView', [RateController::class, 'index']);
    Route::get('/rateCustomView/{id}', [RateController::class, 'show']);
    //FEEDBACK CONTROLLER
    Route::get('/feedbackView', [FeedbackController::class, 'index'])->name('feedbackView.index');
    Route::get('/feedbackReadView', [FeedbackController::class, 'index2'])->name('feedbackReadView.index');
    Route::post('/feedbackRead/{feedback}', [FeedbackController::class, 'feedbackRead'])->name('feedback.read');
    Route::delete('/feedbackDelete/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.delete');

});

require __DIR__.'/auth.php';
