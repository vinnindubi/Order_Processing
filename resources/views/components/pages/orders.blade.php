@extends('components.layout.app')
@section('content')

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">All Orders</h5>
              <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <a href="{{route('order.home')}}" class='btn btn-primary me-md-2'>Create Order</a>
              </div>
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order Id</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Payment Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orderData as $order)
                  <tr>
                    <th scope="row">{{$loop->iteration}} </th>
                    <td>ORD-{{$order->id}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->amount}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>
                      <div class="ms-auto">
                        <div class="dropdown">
                          <a href="javascript:void(0)" class="text-muted" id="year1-dropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-dots fs-7"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="year1-dropdown">
                            <li>
                              <a class="dropdown-item" href="{{route('order.show',$order->id)}}">View order</a>
                            </li>
                            <li>
                              <form action="{{route('order.destroy',$order->id)}}" method="POST"  >
                                @csrf
                                @method('DELETE')
                              <a type="submit" class="dropdown-item"
                              onclick="return confirm('Are you sure you want to delete this order?')"
                              >Delete</a>
                              
                            </form>
                            </li>
                          </ul>
                        </div>
                    </td>
                  </tr>
                  @endforeach
                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
 
@endsection