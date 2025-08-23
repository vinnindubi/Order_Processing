<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
   public function index(){
    $data=Product::all();
    return view('components.pages.products',['ProductsData'=>$data]);
    // return response()->json([
    //     "data"=>$data
    // ],200);
    }
   
   public function show($id){
    $data=Product::find($id);
    return response()->json([
        "data"=>$data
    ],200);
   }
   public function store(Request $request){
    $validated=$request->validate([
        "name"=>"required|min:4",
        "stock"=>"required|numeric",
        "price"=>"required|numeric",
        "description"=>"required|string|max:200"
    ]);
    $data=Product::create([
        "name"=>$validated['name'],
        "stock"=>$validated['stock'],
        "price"=>$validated['price'],
        "description"=>$validated['description']
    ]);

    return response()->json([
        "data"=>$data
    ],200);
   }
   public function update(Request $request, $id){
    $data=Product::find($id);
    $validated=$request->validate([
        "name"=>"sometimes|min:4",
        "stock"=>"sometimes|numeric",
        "price"=>"sometimes|numeric",
        "description"=>"sometimes|string|max:200"
    ]);
    $data->update([
        "name"=>$validated['name'],
        "stock"=>$validated['stock'],
        "price"=>$validated['price'],
        "description"=>$validated['description']
    ]);

    return response()->json([
        "data"=>$data
    ],200);
   }
   public function destroy($id){
    $data=Product::find($id);
    $data->delete();

    return response()->json([
        "message"=>"product deleted successfully"
    ]);
   }
}
