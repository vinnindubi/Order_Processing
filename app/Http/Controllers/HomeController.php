<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('dashboard');
    }
    public function register(){
        return view('components.pages.register');
    }
    public function login(){
        return view('components.pages.login');
    }
    public function page1(){
        return view('components.pages.page1');
    }
}
