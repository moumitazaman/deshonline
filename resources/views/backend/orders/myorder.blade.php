@extends('backend.layouts.app')

@section('title', 'Order')

@push('styles')
<!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<!-- Sweetalert 2 -->
<link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@section('content')  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            {{-- Messages will display here --}}
            @include('backend.layouts.flash')
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Order List</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Order</a></li>
                  <li class="breadcrumb-item active">Order</li>
                  <li class="breadcrumb-item active">Orders</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
  
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>#OrderID</th>

                      <th>Name</th>
                      <th>City</th>

                      <th>Total Item</th>
                      <th>Amount</th>
                      <th>Status</th>



                      <th>Order Date</th>
                                            <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                     
   @foreach($orders as $order)
   <?php 
                        $uid= $order->user_id;
                        $user= App\User::latest()->where('id',$uid)->first();

                        ?>
                      <tr>
                        <td>{{ $order->order_id}}</td>

                       
                        <td>{{$user->first_name}} {{$user->last_name}}</td>

                        <td>{{ $user->city}}</td>
                        <td>{{ $order->total_item}}</td>
                        <td>{{ $order->total_amount}}</td>

                        <td>{{ $order->status}}</td>

                        <td>{{ $order->order_date }}</td>
                        <td>
                        <a href="{{ route('backend.order.show', $order->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('backend.order.show', $order->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-print"></i></a>

                        
                        </td>
                      </tr>
   @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>#OrderID</th>

                      <th>Name</th>
                      <th>City</th>

                      <th>Total Item</th>
                      <th>Amount</th>
                      <th>Status</th>



                      <th>Order Date</th>
                                            <th>Action</th>

                    </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endsection

@push('scripts')
<!-- DataTables -->
  <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <!-- Sweetalert2 -->
  <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- page script -->
  <script>
    $(function () {
      $("#datatable").DataTable();
    });

    function deleteBill(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          event.preventDefault();
          $('#delete-form-'+id).submit();
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    }
  </script>
@endpush