@extends('components.layout.app')

@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">

        <form id="orderForm" action="{{ route('orders.store') }}" method="POST">
            @csrf

            <!-- Customer phone number -->
            <div class="mb-3">
                <label for="phone" class="form-label">Customer Phone Number</label>
                <input type="text" name="phone_number" id="phone" class="form-control" required>
            </div>

            <h4>Select Products</h4>
            <div class="row">
                @foreach($ProductsData as $product)
                    <div class="col-md-3 mb-3">
                        <div class="card h-100 shadow-sm p-3">
                            <h5>{{ $product->name }}</h5>
                            <p>Price: Ksh {{ $product->price }}</p>
                            <p>{{ $product->description }}</p>

                            <!-- Checkbox to select product -->
                            <input type="checkbox" name="items[{{ $product->id }}][selected]" value="1" 
                                   class="form-check-input product-check" data-id="{{ $product->id }}" 
                                   data-price="{{ $product->price }} " >
                            Select this product

                            <!-- Quantity input (disabled until checkbox checked) -->
                            <input type="number" name="items[{{ $product->id }}][no_goods]" 
                                   class="form-control mt-2 qty-input" 
                                   placeholder="Quantity" min="1" max="100" disabled>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Totals Section -->
            <div class="mt-4">
                <h5>Total Items: <span id="totalItems">0</span></h5>
                <h5>Total Price: Ksh <span id="totalPrice">0</span></h5>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Place Order</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded',function(){
        const checkboxes=document.querySelectorAll('.product-check');
        const totalItemsEl=document.getElementById('totalItems');
        const totalPriceEl=document.getElementById('totalPrice');

        function updateOrder(){
             let totalQuantity = 0;
            let totalPrice = 0;           

            checkboxes.forEach((checkbox) => {
            const singleCard = checkbox.closest('.card');
            const quantInput = singleCard.querySelector('.qty-input');
            let price=0;
            let quantity=0;
            let wholePrice=0;

                if(checkbox.checked && quantInput.value){
                        const price = parseFloat(checkbox.getAttribute('data-price'));
                            quantity =parseInt(quantInput.value) || 0;
                            wholePrice= quantity * price;
                }
                totalQuantity+=quantity;
                totalPrice+=wholePrice;
            });
            totalItemsEl.textContent=totalQuantity;
            totalPriceEl.textContent=totalPrice;
             
        }
        checkboxes.forEach((checkbox) => {
            const singleCard= checkbox.closest('.card');
            const quantInput = singleCard.querySelector('.qty-input');// gets element 

            checkbox.addEventListener('change', function () {

                quantInput.disabled = !this.checked;
                if(!this.checked){
                    quantInput.value = "";
                }
                updateOrder();
            });
            quantInput.addEventListener('input',updateOrder);

        });
    });


    
    </script>  

@endsection
