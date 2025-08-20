<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
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
            "data"=>$data->products
        ]);
    }
    public function store(Request $request){
        $overAllAmount=0;
        $overAllquantity=0;
        $validated=$request->validate([
            "items"=>"required|array",
            "items.*.product_id"=>"required|exists:products,id",
            "items.*.no_goods"=>"required|min:1",
        ]);
        $data=Order::create([
            "quantity"=>0,
            'amount'=>0,
            
        ]);
        /*her we are creating multiple record in the orderItem table .
        so we are collecting an array of products then we loop as we create them*/
        foreach( $validated['items'] as $item )
        {
            $value=Product::findOrFail($item['product_id']);
            $totalAmount= $value->price * $item['no_goods'];
            OrderItem::create([
                "order_id"=>$data->id,
                "product_id"=>$item['product_id'],
                "no_goods"=>$item['no_goods'],
                "total_amount"=>$totalAmount
            ]);

            $overAllquantity+=$item['no_goods'];
            $overAllAmount+=$totalAmount;
        }
            $result=$data->update([
                "quantity"=>$overAllquantity,
            'amount'=>$overAllAmount,
            ]);

        return response()->json([
            "message"=>"order created successfully",
            "data"=>$result
        ]);
    }
    public function update(Request $request, $id){
        $overAllQuantity=0;
        $overAllAmount=0;
        $validated=$request->validate([
            "items"=>"required|array",
            "items.*.product_id"=>"required|exists:products,id",
            "items.*.no_goods"=>"required|integer|min:1",
        ]);
        $data=Order::find($id);
        
        $value=OrderItem::where('order_id',$id);
        foreach($validated['items'] as $item){
            $product=Product::findOrFail($item['product_id']);
            $totalAmount=$product->price * $item['no_goods'];
            $value->update([
                "order_id"=>$data->id,
                "product_id"=>$item['product_id'],
                "no_goods"=>$item['no_goods'],
                "total_amount"=>$totalAmount
            ]);
            $overAllQuantity+= $item['no_goods'];
            $overAllAmount+=$totalAmount;
        }
        $result=$data->update([
            "quantity"=>$overAllQuantity,
            'amount'=>$overAllAmount,
        ]);
        return response()->json([
            "message"=>"order Updated Successfully",
            "data"=>$result
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
