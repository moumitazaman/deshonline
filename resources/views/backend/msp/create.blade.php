@extends('backend.layouts.app')

@section('title', 'Create M.S.P')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">MSPs</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">MSPs</li>
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
          <form action="{{ route('backend.msp.update','1') }}" id="sales_info" method="POST">
            @csrf
            @method('PUT')

            <div class="card-header">
              <h3 class="card-title">MSP Settings</h3> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 offset-md-3">
                  
                  <div class="form-group">
                    <label for="email">A</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="apoint" placeholder="Points" value="{{ $settings->A }}">
                        
                        
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">B</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="bpoint" placeholder="Points" value="{{ $settings->B}}">
                       
                       
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">C</label>
                    <div class="input-group">
                        <input type="text" class="form-control " name="cpoint" placeholder="Points" value="{{ $settings->C }}">
                       
                       
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">D</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="dpoint" placeholder=" Points" value="{{ $settings->D }}">
                       
                       
                    </div>
                  </div>



                  <div class="form-group">
                    <label for="email">E</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="epoint" placeholder="Points" value="{{ $settings->E }}">
                       
                        
                    </div>
                  </div>
                  
                  
                


                  <div class="row">
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-md btn-success"><i class="fas fa-save"></i> Save</button>
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