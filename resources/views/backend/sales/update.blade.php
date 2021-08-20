@extends('backend.layouts.app')

@section('title', 'Create Product')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
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
          <form action="{{ route('backend.settings.update', $setting->id) }}" id="sales_info" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
              <h3 class="card-title">Change Settings</h3> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="form-group mb-3">
                    <label for="email">VAT NO.</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('vat_no') is-invalid @enderror" name="vat_no" placeholder="300570408600003" value="@if(isset($setting->vat_no)){{ $setting->vat_no}}@else{{ old('vat_no') }}@endif">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                        </div>
                        @error('vat_no')
                          <div class="invalid-feedback">{{ $errors->first('vat_no') }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Price Per KG.</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('price_per_kg') is-invalid @enderror" name="price_per_kg" placeholder="Example: 45" value="@if(isset($setting->price_per_kg)){{ $setting->price_per_kg }}@else{{ old('price_per_kg') }}@endif">
                        <div class="input-group-append">
                            <span class="input-group-text">SR</span>
                        </div>
                        @error('price_per_kg')
                          <div class="invalid-feedback">{{ $errors->first('price_per_kg') }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">VAT Value.</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('vat_value') is-invalid @enderror" name="vat_value" placeholder="Example: 45" value="@if(isset($setting->vat_value)){{ $setting->vat_value }}@else{{ old('vat_value') }}@endif">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                        </div>
                        @error('vat_value')
                          <div class="invalid-feedback">{{ $errors->first('vat_value') }}</div>
                        @enderror
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