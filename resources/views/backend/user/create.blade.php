@extends('backend.layouts.app')

@section('title', 'Create User')

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
              <h1 class="m-0 text-dark">User Form</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User</li>
                <li class="breadcrumb-item active">User Form</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="card card-default">
            <!-- form -->
            <form action="{{ route('backend.user.store') }}" id="sales_info" method="POST">
              @csrf
              <div class="card-header">
                <h3 class="card-title">Create User</h3>

                <!-- <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                      class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                      class="fas fa-remove"></i></button>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <div class="row">
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}">
                          @error('email')
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}">
                          @error('name')
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label for="phone_number">Phone Number</label>
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                          @error('phone')
                            <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label for="phone_number">Select Branch</label>
                          <select name="branch_id" id="branch" class="form-control @error('branch_id') is-invalid @enderror">
                            <option value="">--Select Branch--</option>
                            @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ ucfirst($branch->name) }}</option>
                            @endforeach
                          </select>
                          @error('branch_id')
                            <div class="invalid-feedback">{{ $errors->first('branch_id') }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="******" value="{{ old('password') }}">
                          @error('password')
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label for="role_id">Select User Role</label>
                          <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                            <option value="">--Select User Type--</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                          </select>
                          @error('role_id')
                            <div class="invalid-feedback">{{ $errors->first('role_id') }}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-md btn-success"><i class="fas fa-save"></i> Save</button>
                        <a href="{{ route('backend.user.create') }}" class="btn btn-md btn-warning"><i class="fas fa-plus"></i> New User</a>
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