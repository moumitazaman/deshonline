@extends('backend.layouts.app')

@section('title', 'Create Attributes')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            {{-- Messages will display here --}}
            @include('backend.layouts.flash')
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Attributes Form</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Attributes</li>
                  <li class="breadcrumb-item active">Attributes Form</li>
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
              <form action="{{ route('backend.attributes.store') }}" id="sales_info" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                  <h3 class="card-title">Create Attributes</h3> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="email">For Device</label>
                        <select name="device" id="device" class="form-control" required>
                          <option value="">--Select Option--</option>
                          <option value="all">All</option>

                          <option value="laptop">Laptop</option>

                          <option value="desktop">Desktop</option>
                          <option value="mouse">Mouse</option>
                          <option value="Keyboard">Keyboard</option>





                          
                        </select>
                        
                      </div>
                      <div class="form-group">
                        <label for="email">Attributes Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Attributes" value="{{ old('name') }}">
                        @error('name')
                          <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="email">Code</label>
                        <select name="code" id="code" class="form-control">
                          <option value="">--Select Code--</option>
                          <option value="checkbox">Checkboxes</option>

                          <option value="select">Select</option>
                          <option value="textarea">TextArea</option>




                          
                        </select>
                        
                      </div>
                      
                     
  
                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" class="btn btn-md btn-success"><i class="fas fa-save"></i> Save</button>
                          <a href="{{ route('backend.attributes.create') }}" class="btn btn-md btn-warning"><i class="fas fa-plus"></i> New Attributes</a>
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