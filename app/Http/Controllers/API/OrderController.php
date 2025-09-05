<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function home(){
        $data = Order::all();
        return response()->json([
            "data"=>$data
        ],200);
        return view('components.pages.orders',['orderData'=> $data]);
        }
    public function show($id){
        $data=Order::find($id);
        $value= $data->products;
        return response($value);
        
    }
    public function download($id){
        $data=Order::find($id);
        $value= $data->products;
        $pdf= Pdf::loadView('components.forms.invoice',[
            'orderData'=>$data,
            'ordeItems'=>$value 
        ]);

        return $pdf->download('invoice.pdf');
    }
    
    public function createOrder(){
        $value=Customer::all();
        $data=Product::all();
        return view('components.forms.createOrderForm',['ProductsData'=>$data,'customerData'=>$value]);
    }
    
    public function store(Request $request){
        $overAllAmount=0;
        $overAllquantity=0;
        $validated=$request->validate([
            "customer_id"=>"required|exists:customers,id",
            "items"=>"required|array",
            "items.*.product_id"=>"required|exists:products,id",
            "items.*.no_goods"=>"required|min:1",
        ]);

        //$value= Customer::find($validated['customer_id']);
        $data=Order::create([
            "quantity"=>0,
            'amount'=>0,
            "customer_id"=>$validated['customer_id']
            
        ]);
        /*here we are creating multiple record in the orderItem table .
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
           $data->update([
                "quantity"=>$overAllquantity,
            'amount'=>$overAllAmount,
            ]);
            
        return response()->json([
            "message"=>"order created successfully"
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
        $data=Order::findOrFail($id);
       
         $data->orderItems()->delete();

        foreach($validated['items'] as $item){
            $product=Product::findOrFail($item['product_id']);

            $totalAmount=$product->price * $item['no_goods'];

            // $data->orderItems()->updateOrCreate([
            //     //find by these
            //     [
            //         "order_id"=>$data->id
                
            //     ],//update or create these
            //     [
                    
            //     "product_id"=>$item['product_id'],
            //     "no_goods"=>$item['no_goods'],
            //     "total_amount"=>$totalAmount

            //     ]
            // ]);

            $data->orderItems()->create([
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
            'amount'=>$overAllAmount
        ]);
        return response()->json([
            "message"=>"order Updated Successfully",
            "data"=>$data->orderItems
        ]);


    }
    public function deleteProduct( Request $request,$id){
        $data=Order::find($id);
        $result=$data->orderItems()->where('product_id',$request->id)->delete();
        
     // Recompute totals after deletion
     $totalQuantity = $data->orderItems()->sum('no_goods'); // sum of all goods
     $totalAmount   = $data->orderItems()->sum('total_amount'); // sum of all amounts
 
     // Update the order with new totals
     $data->update([
         'quantity' => $totalQuantity,
         'amount'   => $totalAmount,
     ]);

    }
    public function destroy($id){
        $data=Order::find($id);
        $data->delete();
        Alert::success('Deletion','Order deleted succesfully');
        return redirect('/orders');
    }
}
