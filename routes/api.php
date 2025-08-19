<?php

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/', function () {
    return view('welcome');
});
Route::post('/register',[HomeController::class,'register']);
Route::apiResource('/customers',HomeController::class);
Route::resource('/login',HomeController::class);
Route::get('/stkPush',[PaymentController::class,'stkPush']);
Route::post('/mpesaCallback',[PaymentController::class,'mpesaCallback']);
Route::apiResource('/products',ProductController::class);
// Route::route('/products/orders',OrderController::class);
Route::get('/orders/list',[OrderController::class ,'home']);
Route::get('/orders/list/{id}',[OrderController::class ,'show']);
Route::put('/orders/list/{id}',[OrderController::class ,'update']);
Route::resource('/orders',OrderController::class);
