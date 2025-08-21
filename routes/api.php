<?php

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PermissionRoleController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/', function () {
    return view('welcome');
});
Route::post('/register',[HomeController::class,'register']);
Route::resource('/login',HomeController::class);

Route::apiResource('/customers',CustomerController::class);

Route::post('/roles/assignPermission',[PermissionRoleController::class,'assignRole']);
Route::apiResource('/roles',RoleController::class);

Route::get('/stkPush',[PaymentController::class,'stkPush']);
Route::post('/mpesaCallback',[PaymentController::class,'mpesaCallback']);
Route::apiResource('/products',ProductController::class);
Route::get('/orders/list',[OrderController::class ,'home']);
Route::get('/orders/list/{id}',[OrderController::class ,'show']);
Route::put('/orders/list/{id}',[OrderController::class ,'update']);
Route::post('/orders',[OrderController::class,'store']);
Route::delete('/orders/{id}',[OrderController::class,'destroy']);
Route::delete('/ordersItems/{id}',[OrderController::class ,'deleteProduct']);
