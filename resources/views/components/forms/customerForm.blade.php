@extends('components.layout.app')
@section('content')

<div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="card">
            <div class="card-body">
                <form action="{{route('customer.store')}}" id="createCustomer" method="POST">
                  @csrf
                    <div class="row mb-3">
                      <label for="customerName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="customerName" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="phoneNumber" class="col-sm-2 col-form-label"> Phone Number</label>
                      <div class="col-sm-10">
                        <input  type="tel" pattern="[0-9]{10}" name="phone_number" class="form-control" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password"   required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                      <div class="col-sm-10">
                        <input type="password"  class="form-control" name="confirm_password" required>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                  </form>
                        
            </div>
        </div>
    </div>
</div>
@endsection