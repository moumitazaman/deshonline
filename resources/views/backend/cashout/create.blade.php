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
              <li class="breadcrumb-item active">Cash Out</li>
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
          <form action="{{ route('backend.cashout.store') }}" id="sales_info" method="POST">
            @csrf
\
            <div class="card-header">
              <h3 class="card-title">Cash Out</h3> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 offset-md-3">

                <?php 
                    
                    $total= DB::table('users')->where('seller_id',Auth::user()->seller_id)->select('points')->first();
                    $income=($total->points)*10;
                    
                    ?>

<div class="form-group mb-3">
                    <label >Total Estimated Income Amount</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="total" value="{{$income}}" readonly>
                        
                    </div>
                  </div>
                 





                  <div class="form-group mb-3">
                    <label >CashOut Amount</label>
                    <div class="input-group">
                        <input type="text" class="form-control" required name="amount" placeholder="Amount">
                        <input type="hidden" name="seller_id" value="{{ Auth::user()->seller_id }}">
                        <input type="hidden" name="ref_id" value="{{ Auth::user()->ref_id }}">

                    </div>
                  </div>
                 
                
                

                  <div class="row">
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-md btn-success"><i class="fas fa-save"></i> Submit</button>
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