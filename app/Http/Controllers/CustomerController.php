<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
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
    public function store(Request $request){
        $validated=$request->validate([

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
