<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[HomeController::class,'index']);
Route::get('/register',[HomeController::class,'register']);
Route::get('/login',[HomeController::class,'login']);
Route::get('/page1',[HomeController::class,'page1']);