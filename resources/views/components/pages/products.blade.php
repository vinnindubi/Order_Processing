@extends('components.layout.app')
@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <h3 class="mb-4">All Products</h3>
        <div class="row">
            @foreach($ProductsData as $product)
                <div class="col-md-3 mb-2">
                    <div class="card h-100 shadow-sm ">
                            <p class="product-id" hidden>{{$product->id}}</p>
                            <h5 class="card-title card-needed ">{{ $product->name }}</h5>
                            <p class="card-text text-muted ">
                                {{ $product->description }}
                            </p>
                            <h6 class="text-primary productPrice">Ksh {{ number_format($product->price, 2) }}</h6>                    
                            <button id="addToCartBtn" type="button"  class="btn btn-sm btn-success text-center ">Add to Cart</button>         
                            <button class="btn btn-sm btn-outline-primary mt-2 text-center">View</button>                  
                    </div>
                </div>
            @endforeach
            {{-- shopping cart code --}}
        <div class=" cartBox position-absolute h-100 w-100 d-flex justify-content-center align-items-center  ">   
            <div class=" p-2 bg-white w-100 h-100 ">
                <div class="d-flex">
                    <h3 class="flex-grow-1 text-center m-0 color-blue text-primary">Shopping Cart</h3>
                    <button type="button" class="btn-close cartButton ms-2 " aria-label="Close"></button>
                </div>
                    <div>
                    <table class="table table-striped table-bordered table-hover retrive-table">
                    {{-- <thead class="  table-info" >
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody class="table-bordered">
                        <tr>
                        <td> name</td>
                        <td> price</td>
                        <td> quantity</td>
                        <td> Total price</td>
                    </tr>
                    </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>       
 </div>
</div>

@endsection
@section('style')
<style>
   .cartButton:hover {
        background-color: red ;
    }
    .cartBox{
        transition: 0.3 linear;
         transform: scale(0);     /*scale(0) means shrink the element to 0% of its size → it becomes invisible (but still exists in the DOM). */
    }
    .cartBox.active{
        transform: scale(1);
    }  /* scale(1) means 100% of its original size.
    So when you add the .active class, the element grows back to its normal size.*/
</style>
    
@endsection