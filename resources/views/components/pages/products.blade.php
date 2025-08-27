@extends('components.layout.app')

@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <h3 class="mb-4">All Products</h3>
        

        <div class="row">
            @foreach($ProductsData as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        {{-- Product Image --}}
                        {{-- <img src="{{ $product->image_url ?? asset('assets/images/default-product.jpg') }}" 
                             class="card-img-top" alt="{{ $product->name }}"> --}}

                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">
                                {{ $product->description }}
                            </p>
                            <h6 class="text-primary">Ksh {{ number_format($product->price, 2) }}</h6>
                        </div>

                        <div class="card-footer bg-white text-center ">
                           <form action="{{route('cart.store')}}" method="POST">
                            @csrf 
                            <button type="button"  class="btn btn-sm btn-success ">Add to Cart</button>
                           </form>
                            <button class="btn btn-sm btn-outline-primary mt-2">View</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
{{-- shopping cart code --}}
<div class=" cartBox position-fixed top-0 start-0 h-100 w-100 d-flex justify-content-center align-items-center  bg-dark bg-opacity-75 z-9999">
    
    <div class=" cart d-flex  p-2 bg-white w-50 h-25">
        <h3 class="flex-grow-1 text-center m-0 color-blue text-primary">Shopping Cart</h3>
        <button type="button" class="btn-close cartButton ms-2 " aria-label="Close"></button>
    </div>
    <div>
        <table>
            <thead>
                <th>pr</th>
            </thead>
        </table>
    </div>
</div>

</div>
@endsection
@section('scripts')
    <script>
       // const cartItems= document.querySelector('shoppingCartItem')
 
        
    </script>
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