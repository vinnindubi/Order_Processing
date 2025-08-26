@extends('components.layout.app')
@section('content')

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              @if (session('success'))
                          <div class="alert alert-success">
                            {{ session('success') }}
                          </div>
              @endif
                        {{-- Show validation errors --}}
              @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
              @endif
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
                      <form  id="delete-form-{{ $customer->id }} action="{{route('customer.destroy',$customer->id)}}" method="POST"  >
                          @csrf
                          @method('DELETE')
                        <button type="button" onclick="confirmDelete({{ $customer->id }})" class="btn btn-outline-danger" >Delete</button>
                        
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

@section('scripts')
    <script>
      
      function confirmDelete(customerId) {
          Swal.fire({
              title: 'Are you sure?',
              text: "This action cannot be undone!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('delete-form-' + customerId).submit();
              }
          });
      }
        
</script>
@endsection