@extends('backend.layouts.app')

@section('title', 'View Profile')

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
                <h1 class="m-0 text-dark">Seller Profile</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Seller Profile</li>
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
  		<div class="col-sm-10"><h1>{{$seller->first_name}} {{$seller->last_name}}</h1></div>
    	<div class="col-sm-2"></div>
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              
      <form class="form" enctype="multipart/form-data" action="{{ route('backend.profile.update',$seller->seller_id) }}" method="POST" id="registrationForm">
                  @csrf

      <div class="text-center">
        <img id="blah" class="avatar img-circle img-thumbnail" alt="avatar" src="<?php echo asset('/').'uploads/profile/'.$seller->img_name;?>" alt="your image" />

        <input type="file" name="image" id="imgInp" class="text-center center-block file-upload">
      </div></hr><br>

               
      
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>

            <li class="list-group-item text-right"><span class="pull-left"><strong>Points</strong></span> {{$seller->points}}</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Matches</strong></span> {{$seller->matches}}</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Grade</strong></span> {{$seller->grade}}</li>

          </ul> 
               
         
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
           

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                 

                     
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>First name</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" value="{{$seller->first_name}}" placeholder="first name" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Last name</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" value="{{$seller->last_name}}" placeholder="last name" title="enter your last name if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Phone</h4></label>
                              <input type="text" class="form-control" name="phone" value="{{$seller->phone}}" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                          </div>
                      </div>
          
                      
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" value="{{$seller->email}}" placeholder="you@email.com" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Address</h4></label>
                              <input type="text" name="address" class="form-control" id="location" value="{{$seller->address}}" placeholder="somewhere" title="enter a location">
                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>City</h4></label>
                              <input type="text" class="form-control" id="location" name="city" value="{{$seller->city}}" placeholder="somewhere" title="enter a location">
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