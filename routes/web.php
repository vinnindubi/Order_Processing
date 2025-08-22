<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PermissionRoleController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
});
// Route::get('/',[HomeController::class,'index']);
Route::get('/register',[HomeController::class,'showFormRegister']);
Route::post('/register',[HomeController::class,'register']);
Route::get('/login',[HomeController::class,'login']);
Route::get('/customers',[HomeController::class,'customers']);
Route::get('/create',[HomeController::class,'create'])->name('customer.create');


// 

Route::get('/customers/{id}/orders',[CustomerController::class,'getOrders']);
Route::post('/customersLogin',[CustomerController::class,'customerLogin']);

//customer controller
Route::get('/customers',[CustomerController::class,'index'])->name('customer.index');
Route::get('/customers/{id}',[CustomerController::class,'show']);
Route::put('/customers/{id}',[CustomerController::class,'update']);
Route::delete('/customers/{id}',[CustomerController::class,'destroy'])->name('customer.destroy');



Route::post('/roles/assignPermission',[PermissionRoleController::class,'assignRole']);
Route::apiResource('/roles',RoleController::class);

Route::get('/stkPush',[PaymentController::class,'stkPush']);
Route::post('/mpesaCallback',[PaymentController::class,'mpesaCallback']);
Route::apiResource('/products',ProductController::class);
Route::get('/showOrders/{id}',[OrderController::class ,'show'])->name('order.show');
Route::get('/orders',[OrderController::class ,'home'])->name('order.home');
Route::put('/orders/{id}',[OrderController::class ,'update'])->name('order.update');
Route::post('/orders',[OrderController::class,'store']);
Route::delete('/orders/{id}',[OrderController::class,'destroy'])->name('order.destroy');
Route::delete('/ordersItems/{id}',[OrderController::class ,'deleteProduct']);
