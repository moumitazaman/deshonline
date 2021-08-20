@extends('backend.layouts.app')

@section('title', 'Assign Role')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Role Assign Form</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Role Assign</li>
                  <li class="breadcrumb-item active">Role Assign Form</li>
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
              <form action="{{ route('backend.permission.update', $seller->id) }}" id="sales_info" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                  <h3 class="card-title">Role Assign</h3> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 offset-md-3">
                      <div class="form-group">
                        <label for="email">Seller Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  value="{{ $seller->first_name }}">
                        @error('name')
                          <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="name">Role</label>

                        <select name="role" id="role" class="form-control" >
                            <option>Select Role</option>
                          @foreach ($roles as $cat)
                          
                          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                         
                          @endforeach
                        </select>
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

      <script>
      function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
      </script>
@endsection