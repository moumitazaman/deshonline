@extends('backend.layouts.app')

@section('title', 'Create Product')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product Form</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Product</li>
                  <li class="breadcrumb-item active">Product Form</li>
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
              <form action="{{ route('backend.product.store') }}" id="sales_info" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                  <h3 class="card-title">Add Product</h3> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                

                  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Product Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Product Name" value="{{ old('name') }}" required>
                        
                      </div>
                      <div class="form-group">
                          <label for="name">Quantity</label>
                          <input type="text" class="form-control" name="quantity" placeholder="Example: 45" required value="{{ old('storage_size') }}">
                          
                        </div>
                        <div class="form-group">
                          <label for="name">Price</label>
                          <input type="text" class="form-control" name="price" required value="{{ old('storage_size') }}">
                         
                        </div>
                        <div class="form-group">
                          <label for="name">Discounted Price</label>
                          <input type="text" class="form-control" name="discount_price" required value="{{ old('storage_size') }}">

                        </div>
                        
                         <div class="form-group">
                          <label for="name">Points</label>
                          <input type="text" class="form-control" name="points" placeholder="Example: 45" required value="{{ old('points') }}">
                          
                        </div>
                        
                        
                        
                        <div class="form-group">
                          <label for="name">Details</label>
                          <textarea name="details"  class="form-control" placeholder="" required></textarea>

                        </div>
                        <div class="form-group">
                        <label for="name">Category</label>

                        <select name="category" id="category" class="form-control" required>
                          <option value="">--Select Category--</option>
                          @foreach ($categories as $category)
                              <option value="{{ $category->id }}"
                                
                              >{{ $category->category_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="name">SubCategory</label>

                        <select name="subcategory" id="subcategory" class="form-control" required>
                          <option value="">--Select SubCategory--</option>
                          <option value=""></option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="name">Brand</label>

                        <select name="brand" id="brand" class="form-control" required>
                          <option value="">--Select Brand--</option>
                          @foreach ($brands as $brand)
                              <option value="{{ $brand->id }}"
                                
                              >{{ $brand->brand_name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                          <label for="name">Upload Image</label>
                          <input type="file" name="image" class="form-control" id="imgInp" required>
                          <img id="blah" width="250px" src="<?php echo asset('/').'backend/img/preview.png';?>" alt="your image" />
                        </div>

                        <div class="form-group">
                          <label for="name">Upload Gallery Image</label>
                          <input  type="file" class="form-control" name="galleryimages[]" placeholder="Gallery Image" multiple>

                        </div>
                      
                     </div>
                     
                      
                      

                      <div class="col-md-6"> 
                     <!-- <label for="name">Attributes</label>
                      <div class="form-group">
                        <label for="device">For Device  
                        <form id=deviceform>
                        {{ csrf_field() }}
                        <select name="device" id="device" class="form-control">
                          <option value="">--Select Option--</option>
                          <option value="all">All</option>

                          <option value="laptop">Laptop</option>

                          <option value="desktop">Desktop</option>
                          <option value="mouse">Mouse</option>
                          <option value="Keyboard">Keyboard</option>





                          
                        </select>
                        </form>-->
                        
                      </div>
                      
                     

                      @foreach ($attrs as $attr)

                      @if($attr->device=='laptop')

                      <div class="laptop">
                      <div class="form-group">

                        <label for="email">{{ $attr->name }}:</label>
                        @if($attr->code=='select')
                       <?php
                       $id=$attr->id;
                        $values= DB::table('attributesvalues')->select('values')->where('attr_id',$id)->where('device','laptop')->get();
                       ?>



                        <select name="attr_select[]" id="code" class="form-control" >
                          <option value="">--Select--</option>
                          @foreach($values as $val)
                          <option value="{{$val->id}}">{{$val->values}}</option>

                          @endforeach
                          </select>
                         

                          @elseif($attr->code=='checkbox')
                       <?php   
                       $id=$attr->id;
                        $values= DB::table('attributesvalues')->where('attr_id',$id)->where('device','laptop')->get();
                       ?>
                                                 @foreach($values as $val)

                          <label for="name">{{$val->values}}</label>

                          <input type="checkbox"  name="attr_check[]"  value="{{$val->id}}">
                          @endforeach

                        
                      

                        
                          
                          @else


                          <textarea name="attr_detail[]"  class="form-control" placeholder="" ></textarea>

                       





                        @endif

                        </div>
                        </div>
                        @endif

          @if($attr->device=='desktop')

<div class="desktop">
<div class="form-group">

  <label for="email">{{ $attr->name }}:</label>
  @if($attr->code=='select')
 <?php
 $id=$attr->id;
  $values= DB::table('attributesvalues')->select('values')->where('attr_id',$id)->where('device','desktop')->get();
 ?>



  <select name="attr_select[]" id="code" class="form-control">
    <option value="">--Select--</option>
    @foreach($values as $val)
    <option value="{{$val->id}}">{{$val->values}}</option>

    @endforeach
    </select>
   

    @elseif($attr->code=='checkbox')
 <?php   
 $id=$attr->id;
  $values= DB::table('attributesvalues')->where('attr_id',$id)->where('device','desktop')->get();
 ?>
                           @foreach($values as $val)

    <label for="name">{{$val->values}}</label>

    <input type="checkbox"  name="attr_check[]"  value="{{$val->id}}">
    @endforeach

  


  
    
    @elseif($attr->code=='textarea')


    <textarea name="attr_detail[]"  class="form-control" placeholder="" ></textarea>

 
@else




  @endif

  </div>
  </div>
  @endif
  @if($attr->device=='mouse')

<div class="mouse">
<div class="form-group">

  <label for="email">{{ $attr->name }}:</label>
  @if($attr->code=='select')
 <?php
 $id=$attr->id;
  $values= DB::table('attributesvalues')->select('values')->where('attr_id',$id)->where('device','mouse')->get();
 ?>



  <select name="attr_select[]" id="code" class="form-control">
    <option value="">--Select--</option>
    @foreach($values as $val)
    <option value="{{$val->id}}">{{$val->values}}</option>

    @endforeach
    </select>
   

    @elseif($attr->code=='checkbox')
 <?php   
 $id=$attr->id;
  $values= DB::table('attributesvalues')->where('attr_id',$id)->where('device','mouse')->get();
 ?>
                           @foreach($values as $val)

    <label for="name">{{$val->values}}</label>

    <input type="checkbox"  name="attr_check[]"  value="{{$val->id}}">
    @endforeach

  


  
    
    @else


    <textarea name="attr_detail[]"  class="form-control" placeholder="" ></textarea>

 





  @endif

  </div>
  </div>
  @endif

  @if($attr->device=='keyboard')

<div class="keyboard">
<div class="form-group">

  <label for="email">{{ $attr->name }}:</label>
  @if($attr->code=='select')
 <?php
 $id=$attr->id;
  $values= DB::table('attributesvalues')->select('values')->where('attr_id',$id)->where('device','keyboard')->get();
 ?>



  <select name="attr_select[]" id="code" class="form-control">
    <option value="">--Select--</option>
    @foreach($values as $val)
    <option value="{{$val->id}}">{{$val->values}}</option>

    @endforeach
    </select>
   

    @elseif($attr->code=='checkbox')
 <?php   
 $id=$attr->id;
  $values= DB::table('attributesvalues')->where('attr_id',$id)->where('device','keyboard')->get();
 ?>
                           @foreach($values as $val)

    <label for="name">{{$val->values}}</label>

    <input type="checkbox"  name="attr_check[]"  value="{{$val->id}}">
    @endforeach

  


  
    
    @else


    <textarea name="attr_detail[]"  class="form-control" placeholder="" ></textarea>

 





  @endif

  </div>
  </div>
  @endif


  @if($attr->device=='all')

<div class="all">
<div class="form-group">

  <label for="email">{{ $attr->name }}:</label>
  @if($attr->code=='select')
 <?php
 $id=$attr->id;
  $values= DB::table('attributesvalues')->select('values')->where('attr_id',$id)->where('device','all')->get();
 ?>



  <select name="attr_select[]" id="code" class="form-control" >
    <option value="">--Select--</option>
    @foreach($values as $val)
    <option value="{{$val->id}}">{{$val->values}}</option>

    @endforeach
    </select>
   

    @elseif($attr->code=='checkbox')
 <?php   
 $id=$attr->id;
  $values= DB::table('attributesvalues')->where('attr_id',$id)->where('device','all')->get();
 ?>
                           @foreach($values as $val)

    <label for="name">{{$val->values}}</label>

    <input type="checkbox"  name="attr_check[]"  value="{{$val->id}}">
    @endforeach

  


  
    
    @else


    <textarea name="attr_detail[]"  class="form-control" placeholder="" ></textarea>

 





  @endif

  </div>
  </div>
  @endif

                        @endforeach










                        
                    
                     

                        
                      </div>
                      
  
                      <div class="row" style="text-align:center; width:100%;">
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-md btn-success"><i class="fas fa-save"></i> Save</button>
                          <a href="{{ route('backend.product.create') }}" class="btn btn-md btn-warning"><i class="fas fa-plus"></i> New Product</a>
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
            $(".laptop").hide(200);
            $(".desktop").hide(200);
            $(".mouse").hide(200);
            $(".keyboard").hide(200);
            $(".all").hide(200);



     $(document).ready(function () {

        $('#device').on('change', function (e) {
        var selectVal = $("#device option:selected").val();
       if(selectVal=='laptop'){
        $(".laptop").show(300);


       }
       else if(selectVal=='desktop'){
        $(".desktop").show(300);


       }
       else if(selectVal=='mouse'){
        $(".mouse").show(300);


       }
       else if(selectVal=='keyboard'){
        $(".keyboard").show(300);


       }
       else if(selectVal=='all'){
        $(".all").show(300);


       }
       else{

       }




        /*$.ajax({
                        headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },  
                      type:"POST",
                      url: "{{ url('/admin/device')}}",
                      data: {device:selectVal},
                      success:function(response){
						
                        console.log(response);

                        
                      },
                      error:function(error){
                        console.log(error)
                        alert("not send");
                      },
              
                      
                    });*/

});
      });

   
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

$('#category').on('change', function(){
    var id = $(this).val();
   /* $.getJSON("getsubcategory/" + id , function(data){
        // Assumed subcategory is id of another select
        alert(response);
        var subcat = $('#subcategory').empty();
        
        $.each(data, function(k, v){
            var option = $('<option/>', {id:k, v});
            subcat.append(option);
        });
    });*/
    $.ajax({
	 headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},  
   type:"GET",
   url: "{{url('admin/product/getsubcategory')}}"+"/"+id,

   success:function(data){
		console.log(data);
    $('#subcategory').empty();
    $.each(data,function(k,v){
      console.log(k);

      console.log(v);
            $('#subcategory').append('<option value ="'+v[0].id+'">'+v[0].sub_category_name+'</option>');
        });

	  
   },
   error:function(error){
	 console.log(error)
	 alert("not send");
   },
    });
});
      </script>
      
@endsection