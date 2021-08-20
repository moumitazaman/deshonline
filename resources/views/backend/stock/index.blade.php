@extends('backend.layouts.app')

@section('title', 'Product List')

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
                <h1 class="m-0 text-dark">Stock</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Stock</li>
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
                    <th>No.</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Opening Stock</th>
                      
                      <th>Current Stock</th>
                      <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $key => $product)    
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $product->product_id }}</td>

                          <td>{{ $product->product_name }}</td>
                          <?php
                          $cat=DB::table('category')->select('category_name')->where('id',$product->category_id)->first();
                          ?>
                          <td>{{$cat->category_name}}</td>
                          <?php
                          $brand=DB::table('brand')->select('brand_name')->where('id',$product->brand_id)->first();
                          ?>
                          <td>{{$brand->brand_name}}</td>
                          <td>{{ $product->stock_quantity }}</td>
                          <td>{{ $product->quantity }}</td>

                         <td>                          <a href="{{ route('backend.product.show', $product->product_id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></a>
</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>No.</th>
                    <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Opening Stock</th>
                      
                      <th>Current Stock</th>
                      <th>View</th>

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

    function deleteProduct(id){
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
