<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    
    public function customerLogin(Request $request){

        $validated=$request->validate([
            "email"=>"required|email|exists:customers:id",
            "password"=>"required|string|min:6"
        ]);
        
    }
    public function index(){
        $data=Customer::all();
        return view('components.pages.customers',['customerData'=>$data]);

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
            "phone_number"=>"required|string",
            "password"=>"required",
            "confirm_password"=>"required|same:password"
        ]);
        $data=Customer::create([
            "name"=>$request->input('name'),
            "phone_number"=>$request->input('phone_number'),
            "password"=>$request->input('password')

        ]);
       
        Alert::success('success','customer created successfully');
        return redirect('/customers');
    }
    public function update(Request $request,$id){
        $data=Customer::find($id);
        $validated=$request->validate([

        ]);
    }
    public function destroy($id){
        $data=Customer::findOrFail($id);
        $data->delete();
        alert()->success('success','customer deleted successfully');
        return redirect()->back();
    }
}
