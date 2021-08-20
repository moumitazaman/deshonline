@extends('backend.layouts.app')

@section('title', 'Create Profile')

@push('styles')
<!-- Select2 -->
  <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
                <h1 class="m-0 text-dark">Create Admin</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Create Admin Profile</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
  
        <div class="content">
          <div class="container-fluid">
            <div class="card card-default">


<!-- /.card-header -->
<div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                    <div class="col-md-12">

                    <div class="container bootstrap snippet">
    
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              
      <form method="POST" action="{{ route('backend.add.admin') }}" class="login-form" enctype="multipart/form-data">
                        @csrf               

<div class="text-center">

  <input type="file" name="image" id="imgInp" class="text-center center-block file-upload">
</div></hr><br>
               
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
           

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                 
                
                        
                     
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>First name</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name"  placeholder="first name" title="enter your first name if any.">
                              <?php 
                                    $role_id= DB::table('roles')->select('id')->where('slug','admin')->first();
                                    ?>
                                    <input type="hidden" name="role_id" value="<?php echo $role_id->id;?>">

                         
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Last name</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name"  placeholder="last name" title="enter your last name if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Phone</h4></label>
                              <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                          </div>
                      </div>
          
                      
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email"  placeholder="you@email.com" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Address</h4></label>
                              <input type="text" name="address" class="form-control" id="location"  placeholder="somewhere" title="enter a location">
                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>City</h4></label>
                              <input type="text" class="form-control" id="location" name="city"  placeholder="somewhere" title="enter a location">
                          </div>
                      </div>

                      <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                                
                      
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                            </div>
                      </div>
              	</form>
              
              <hr>
              
             </div><!--/tab-pane-->
            
                   
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
                      



                    </div>
                    
                    </div>
                    
                    
                      
                    </div>
                  </div>
                  <!-- /.row -->




            </div>
            </div>
            </div>
                      
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                  </div>
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

@push('scripts')
<!-- Select2 -->
  <script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
  {{-- <script src="{{asset('backend/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('backend/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script> --}}
<!-- Custom JS -->
  <script type="text/javascript">
    
    
      


    
  </script>
@endpush