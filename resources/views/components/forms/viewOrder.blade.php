@extends('components.layout.app')

    @section('content')
    <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
                <div class="card-body">
                    <h4>Order number #{{$orderData->id}}</h4>
                    <div >
                       <h5>Customer Details: </h5> 
                       <p>Name: {{$orderData->customer->name}} </p>
                       <p>Phone Number: {{$orderData->customer->phone_number}}</p>
                       <p>Payment Status: {{$orderData->payment_status}}</p>
                       <p>Total Amount: {{$orderData->amount}}</p>
                    </div>
                    <div>
                        <h5> Order </h5>
                        @foreach ($orderData->products as $item)
                        <div>
                            <p>Products Name: {{$item->name}}</p>
                            <p> Quantity: {{$item->pivot->no_goods}}</p>
                            <p> Total price: {{$item->pivot->total_amount}}</p>
                        </div>
                        @endforeach

                    </div>

                    
            </div>
        </div>
    </div>
    @endsection
    @section('scripts')
        
    @endsection