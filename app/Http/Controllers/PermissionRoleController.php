<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Models\Permission;
use App\Models\Role;

class PermissionRoleController extends Controller
{
    public function assignRole(Request $request){
       
        $validated=$request->validate([
            "role_id"=>"required|exists:roles,id",
            "items"=>"required|array",
            "items.*"=>"required|exists:permissions,id"
        ]);
        // foreach($validated['items'] as $item){
            // PermissionRole::create([
            //     "role_id"=>$validated['role_id'],
            //     "permission_id"=>$item
            // ]);
            
        // }
        $data=Role::find($validated['role_id']);
        $value=$data->permissions()->sync($validated['items']);


            
        return response()->json([
            "message"=>"permission assigned to role successfully",
            "data"=>$value
        ]);
    }
}
