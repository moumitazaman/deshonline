@extends('backend.layouts.app')

@section('title', 'Create Product Sales')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Add Seller Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Seller Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        {{-- Messages will display here --}}
        @include('backend.layouts.flash')
        <div class="card card-default">
          <!-- form -->
          <form action="{{ route('backend.sellerproduct.store') }}" id="sales_info" method="POST">
            @csrf
\
            <div class="card-header">
              <h3 class="card-title">Sales Update</h3> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="form-group mb-3">
                    <label >Product ID</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_id" placeholder="Product ID">

                    </div>
                  </div>
                  <div class="form-group">
                    <label>Customer/Seller ID</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="seller_id" placeholder="Seller ID">
                       

                    </div>
                  </div>


                  <div class="form-group">
                    <label>Quantity</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="quantity" placeholder="Item Number" >
                        
                       
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="amount" placeholder="Amount" >
                        
                       
                    </div>
                  </div>
                  

                

                  <div class="row">
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-md btn-success"><i class="fas fa-save"></i> Update</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.row -->
            </div>
          </form>
          <!-- /.form -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection