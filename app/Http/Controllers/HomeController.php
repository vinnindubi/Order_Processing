<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index() {

    return view('dashboard');
}

    public function showFormRegister(){
        return view('components.pages.register');
    }
    public function register(Request $request){
        
        $validated=$request->validate([
            "name"=>"required",
            "email"=>"required|email",
            "password"=>"required"
        ]);
        $data=User::create([
            "name"=>$validated['name'],
            "email"=>$validated['email'],
            "password"=>$validated['password']
        ]);
        
        if ($data){
            return redirect('/login')->with('success','user created successfully');
        }

        
    }
    public function login(){
        return view('components.pages.login');
    }
    public function customers(){
        $data = User::all();
        return view('components.pages.customers', [
            'customerData' => $data]);
    }
    public function create(){
        return view('components.forms.customerForm');
    }
}