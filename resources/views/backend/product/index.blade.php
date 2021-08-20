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
                <h1 class="m-0 text-dark">Products</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Product</li>
                  <li class="breadcrumb-item active">Products</li>
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
                      <th>#ID</th>
                      <th>Image</th>
                      <th>Product ID</th>

                      <th>Name</th>
                      <th>Category</th>
                      <th>SubCategory</th>

                      <th>Brand</th>


                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $key => $product)    
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td><img width="50px" height="50px" src="<?php echo asset('/').'uploads/'.$product->img_name;?>"></td>
                          <td>{{ $product->product_id }}</td>

                          <td>{{ $product->product_name }}</td>
                          <?php
                          $cats=DB::table('category')->select('category_name')->where('id',$product->category_id)->first();
                          ?>
                          <td>{{$cats->category_name}}</td>
                          <?php
                          $subcats=DB::table('subcategory')->select('sub_category_name')->where('id',$product->subcategory_id)->first();
                          ?>
                          <td>{{$subcats->sub_category_name}}</td>
                          <?php
                          $brand=DB::table('brand')->select('brand_name')->where('id',$product->brand_id)->first();
                          ?>
                          <td>{{$brand->brand_name}}</td>
                          <td>{{ $product->quantity }}</td>
                          <td>{{ $product->price }}</td>

                          <td>{{ $product->created_at->format('j F, Y') }}</td>
                          <td>
                                                        <a href="{{ route('backend.product.show', $product->product_id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></a>

                            <a href="{{ route('backend.product.edit', $product->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger" type="button" onclick="deleteProduct({{ $product->id }})"><i class="fas fa-trash"></i></button>
                            <form id="delete-form-{{ $product->id }}" action="{{ route('backend.product.destroy', $product->id) }}" method="post" style="display: none;">
                              @csrf
                              @method('DELETE')
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>#ID</th>
                      <th>Image</th>
                      
                      <th>Product ID</th>

                      <th>Name</th>
                      <th>Category</th>
                      <th>SubCategory</th>

                      <th>Brand</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Created Date</th>
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
