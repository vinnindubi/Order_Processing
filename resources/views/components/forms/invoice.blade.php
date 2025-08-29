<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="/" class="text-nowrap logo-img">
          <img src="assets/images/logos/logo.svg" alt="" />
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-6"></i>
        </div>
      </div>
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
</body>
</html>