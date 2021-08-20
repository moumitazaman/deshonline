@extends('backend.layouts.app')

@section('title', 'Update SubCategory')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">SubCategory Form</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">SubCategory</li>
                  <li class="breadcrumb-item active">SubCategory Form</li>
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
              <form action="{{ route('backend.subcategory.update', $category->id) }}" id="sales_info" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-header">
                  <h3 class="card-title">Update SubCategory</h3> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 offset-md-3">
                      <div class="form-group">
                        <label for="email">SubCategory Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  value="{{ $category->sub_category_name }}">
                        @error('name')
                          <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="name">Category</label>

                        <select name="category" id="category" class="form-control" >
                          @foreach ($categories as $cat)
                          
                          @if(( $cat->id)==($category->category_id))
                          <option value="{{ $cat->id }}" selected>{{ $cat->category_name }}</option>
                          @else
                              <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                              @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label for="name">Upload Icon</label>
                          <input type="file" name="image" class="form-control" id="imgInp">
                          <img id="blah" width="150px" src="<?php echo asset('/').'uploads/icon/'.$cat->icon;?>" alt="your image" />
                        </div>
                        <div class="form-group">
                          <label for="name">Status </label>
                          <select name="status" id="device" class="form-control">
                          <option value="1"  <?php if($category->status=='1'){ echo "selected";}?>>Active</option>

                          <option value="0" <?php if($category->status=='0'){echo "selected";}?>>Deactive</option>
                           
                        </select>
                        </div>
                      </div>
  
                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" class="btn btn-md btn-success"><i class="fas fa-save"></i> Save</button>
                          <a href="{{ route('backend.category.create') }}" class="btn btn-md btn-warning"><i class="fas fa-plus"></i> New Category</a>
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