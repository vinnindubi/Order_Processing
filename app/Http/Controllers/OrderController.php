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
            "data"=>$data->orderItems
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
        /*her we are creating multiple record in the orderItem table .
        so we are collecting an array of products then we loop as we create them*/
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
            "data"=>$value
        ]);
    }
    public function update(Request $request, $id){
        $validated=$request->validate([
            "quantity"=>"required|integer",
            "amount"=>"required|integer",
            "items"=>"required|array",
            "items.*.product_id"=>"required|exists:products,id",
            "items.*.no_goods"=>"required|min:1",
            "items.*.total_amount"=>"required|min:1"
        ]);
        $data=Order::find($id);
        $data->update([
            "quantity"=>$validated['quantity'],
            'amount'=>$validated['amount'],
        ]);
        $value=OrderItem::where('order_id',$id);
        foreach($validated['items'] as $item){
            $value->update([
                "order_id"=>$data->id,
                "product_id"=>$item['product_id'],
                "no_goods"=>$item['no_goods'],
                "total_amount"=>$item['total_amount']
            ]);
        }
        return response()->json([
            "message"=>"order Updated Successfully"
        ]);


    }
    public function destroy($id){
        $data=Order::find($id);
        $data->delete();
        return response()->json([
           "message"=>"order deleted successfully"
        ]);
    }
}
