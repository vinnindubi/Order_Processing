<?php

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/', function () {
    return view('welcome');
});
Route::resource('/register',HomeController::class);
Route::resource('/login',HomeController::class);