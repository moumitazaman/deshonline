@extends('backend.layouts.app')

@section('title', 'Seller List')

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
                <h1 class="m-0 text-dark">Cash Out List</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                
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
                      <th>#Seller ID</th>

                      <th>Total Amount</th>

                      <th>Cashout Amount</th>
                      <th>Current Total Amount</th>

                      <th>Created Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php   
         $sellers = App\CashOut::all();
        
                        
                        ?>
                      @foreach ($sellers as $key => $seller)
                     
                      <tr>
                        <td>{{ $seller->seller_id }} </td>

                        <td>{{ $seller->net}}</td>
<td>{{ $seller->amount}}</td>
<td>{{ $seller->total}}</td>

                        <td>{{ $seller->created_at->format('j F, Y') }}</td>
                       
                      </tr>
                      
                      @endforeach

                   
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>#Seller ID</th>

                      <th>Total Amount</th>

                      <th>Cashout Amount</th>
                      <th>Current Total Amount</th>
                      <th>Created Date</th>
                      
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

    function deleteTeam(id){
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