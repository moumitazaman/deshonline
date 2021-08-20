@extends('backend.layouts.app')

@section('title', 'Cashout')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">CashOut</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">CashOut</li>
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
          <form action="" id="sales_info" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
              <h3 class="card-title">Cash Out</h3> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="form-group mb-3">
                    <label for="email">Total Estimated Income After CashOut</label>
                    <div class="input-group">
                        {{$net}}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Cash Out Amount</label>
                    <div class="input-group">
                        {{$percentage}}
                    </div>
                  </div>
                  <div class="form-group">
                    
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <a href="{{url('/admin/dashboard')}}"><button type="button" class="btn btn-md btn-success"><i class="fas fa-save"></i> Done</button></a>
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