<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function home(){
        $data = Order::all();
        return response()->json([
            "data"=>$data
        ],200);
        }
    public function show($id){
        $data=Order::find($id);
        return response()->json([
            "message"=>"order returned ",
            "data"=>$data
        ]);
    }
    public function store(Request $request){
        $validated=$request->validate([
            "quantity"=>"required|integer",
            "amount"=>"required|integer",
            "items"=>"required|array",
            "items.*.product_id"=>"required|exists:products,id",
            "items.*.no_goods"=>"required|min:1",
            "items.*.total_amount"=>"required|min:1"
        ]);
        $data=Order::create([
            "quantity"=>$validated['quantity'],
            'amount'=>$validated['amount'],
            
        ]);
        foreach( $validated['items'] as $item )
        {
            $value=OrderItem::create([
                "order_id"=>$data->id,
                "product_id"=>$item['product_id'],
                "no_goods"=>$item['no_goods'],
                "total_amount"=>$item['total_amount']
            ]);
        }
        return response()->json([
            "message"=>"order created successfully",
            "data"=>$data->id,
            "orderItem"=>$value
        ]);
    }
    public function update(Request $request, $id){

    }
    public function destroy($id){
        $data=Order::find($id);
        $data->delete();
        return response()->json([
           "message"=>"order deleted successfully"
        ]);
    }
}
