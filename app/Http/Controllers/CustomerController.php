<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    
    public function customerLogin(Request $request){

        $validated=$request->validate([
            "email"=>"required|email|exists:customers:id",
            "password"=>"required|string|min:6"
        ]);
        if(!Auth::guard('customer-api')->attempt($request->only('email','password'))){
            return response()->json([
                "error"=>"unauthorized"
            ],401);
        }
        $customer=Auth::guard('customer-api')->user();
        $token=$customer->createToken('customerToken')->accessToken;
        return response()->json([
            "Token"=>$token
        ]);
    }
    public function index(){
        $data=Customer::all();
        return response()->json([
            "message"=>"customers returned success",
            "data"=>$data
        ],200);

    }
    public function show($id){
        $data=Customer::find($id);
        return response()->json([
            "message"=>"customer returned success",
            "data"=>$data
        ],200);

    }
    public function getOrders($id){
        $data=Customer::find($id);
        $result=$data->orderItems;
        return response($result);
    }
    public function store(Request $request){
        $validated=$request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:customers,email",
            "password"=>"required|string|min:6",
            "confirm_password|same:password"
        ]);
        $data=Customer::create([
            "name"=>$validated['name'],
            "email"=>$validated['email'],
            "password"=>$validated['password']
        ]);
        return response()->json([
            "message"=>"customer created successfully",
            "data"=>$data
        ]);

    }
    public function update(Request $request,$id){
        $data=Customer::find($id);
        $validated=$request->validate([

        ]);
    }
    public function destroy($id){
        $data=Customer::findOrFail($id);
        $data->delete();
        return response()->json([
            "message"=>"customer deleted successfully"
        ]);
    }
}
