<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $data=Role::all();
        return response()->json([
            "data"=>$data
        ]);
    }
    public function show($id){
        $data=Role::find($id);

        return response()->json([
            "data"=>$data
        ]);
        
    }
    public function store(Request $request){
        $validated=$request->validate([
            "name"=>"required",
            "description"=>"required"
        ]);
        $data=Role::create([
            "name"=>$validated['name'],
            "description"=>$validated['description']
        ]);
        if($data){
            return response()->json([
                "message"=>"role created successfully",
                "data"=>$data
            ]);
        }else{
            return response()->json([
                "message"=>"failed to create role"
            ]);
        }
    }
    public function update(Request $request,$id){
        $result=Role::findOrFail($id);
        $validated=$request->validate([]);
        if($result){

            $data=$result->update([]);

            return response()->json([
                "message"=>"role updated",
                "data"=>$data
            ]);
        }
    }
    public function destroy($id){
        $result=Role::findOrFail($id);
        $result->delete();
        return response()->json([
            "message"=>"role deleted successfully"
        ]);
        
    }
}
