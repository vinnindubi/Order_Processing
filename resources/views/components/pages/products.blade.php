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
                        <img src="{{ $product->image_url ?? asset('assets/images/default-product.jpg') }}" 
                             class="card-img-top" alt="{{ $product->name }}">

                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">
                                {{ $product->description }}
                            </p>
                            <h6 class="text-primary">Ksh {{ number_format($product->price, 2) }}</h6>
                        </div>

                        <div class="card-footer bg-white text-center">
                            <button class="btn btn-sm btn-success">Add to Cart</button>
                            <button class="btn btn-sm btn-outline-primary">View</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
