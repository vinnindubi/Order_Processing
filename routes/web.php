<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
Route::get('/', function () {
    return view('dashboard');
});
// Route::get('/',[HomeController::class,'index']);
Route::get('/register',[HomeController::class,'showFormRegister']);
Route::post('/register',[HomeController::class,'register']);
Route::get('/login',[HomeController::class,'login']);
Route::get('/customers',[HomeController::class,'customers']);