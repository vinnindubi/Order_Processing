@extends('components.layout.app')
@section('content')

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Customers</h5>
              <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                <a href="{{route('customer.create')}}" class='btn btn-primary me-md-2'>Create Customer</a>
              </div>
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($customerData as $customer)
                  <tr>
                    <th scope="row">{{$loop->iteration}} </th>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->phone_number}}</td>
                    <td>
                      <div class='d-grid gap-2 d-md-flex '>
                      <button type="button" class="btn btn-outline-success">Update</button>
                      <form action="{{route('customer.destroy',$customer->id)}}" method="POST"  >
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger"
                        onclick="return confirm('Are you sure you want to delete this user?')"
                        >Delete</button>
                        
                      </form>
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