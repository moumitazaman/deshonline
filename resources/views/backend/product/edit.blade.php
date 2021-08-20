@extends('backend.layouts.app')

@section('title', 'Update Product')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product Update Form</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Product</li>
                  <li class="breadcrumb-item active">Product Update Form</li>
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
              <form action="{{ route('backend.product.update',$product->id) }}" id="sales_info" method="POST" enctype="multipart/form-data">
              @csrf
                @method('PUT')
                <div class="card-header">
                  <h3 class="card-title">Update Product</h3> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                

                  
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Product Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->product_name}}">
                        
                      </div>
                      <div class="form-group">
                          <label for="name">Quantity</label>
                          <input type="text" class="form-control" name="quantity"   value="{{$product->quantity}}">
                          
                        </div>
                        <div class="form-group">
                          <label for="name">Price</label>
                          <input type="text" class="form-control" name="price"  value="{{$product->price}}">
                         
                        </div>
                        <div class="form-group">
                          <label for="name">Discounted Price</label>
                          <input type="text" class="form-control" name="discount_price"  value="{{$product->discount_price}}">

                        </div>
                        
                         <div class="form-group">
                          <label for="name">Points</label>
                          <input type="text" class="form-control" name="points"   value="{{$product->points}}">
                          
                        </div>
                        <div class="form-group">
                          <label for="name">Details</label>
                          <textarea name="details"  class="form-control" placeholder="" >{{$product->details}}</textarea>

                        </div>
                        <div class="form-group">
                        <label for="name">Category</label>

                        <select name="category" id="category" class="form-control" >
                          @foreach ($categories as $category)
                          @if(( $category->id)==($product->category_id))
                          <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                          @else
                              <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                              @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="name">SubCategory</label>

                        <select name="subcategory" id="category" class="form-control" >
                          @foreach ($subcategories as $cat)
                          @if(( $cat->id)==($product->category_id))
                          <option value="{{ $cat->id }}" selected>{{ $cat->sub_category_name }}</option>
                          @else
                              <option value="{{ $cat->id }}">{{ $cat->sub_category_name }}</option>
                              @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="name">Brand</label>

                        <select name="brand" id="brand" class="form-control">
                          @foreach ($brands as $brand)
                          @if(( $brand->id)==($product->brand_id))
                          <option value="{{ $brand->id }}" selected>{{ $brand->brand_name }}</option>
                          @else
                              <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                              @endif
                          @endforeach                                
                             
                        </select>
                      </div>

                      <div class="form-group">
                          <label for="name">Upload Image</label>
                          <input type="file" name="image" class="form-control" id="imgInp">
                          <img id="blah" width="250px" src="<?php echo asset('/').'uploads/'.$product->img_name;?>" alt="your image" />
                        </div>
                        <div class="form-group">
                          <label for="name">Upload Gallery Image</label>
                          <input  type="file" class="form-control" name="galleryimages[]" placeholder="Gallery Image" multiple>

                        </div>
                        <div class="col-lg-2 order-lg-1 order-2">
				<ul class="image_list">
				
				<?php 
				$gallery=$product->galleryimages;
				$gall=explode(',',$gallery);
				?>
				@foreach($gall as $gal)
						<li data-image="<?php echo asset('/').'uploads/'.$gal; ?>"><img src="<?php echo asset('/').'uploads/'.$gal; ?>" alt=""></li>
					@endforeach
					</ul>
				</div>
                      
                     </div>
                     <!-- Images -->
			
                     
                      

                      <div class="col-md-6"> 
                      <label for="name">Attributes</label>
              @if($productattributes->attr_id)
                   @foreach ($productattributes->attr_id as $attrid)
                            
                   <?php  
                   $atts = App\Attributes::where('id',$attrid)->get();
                   ?>


                      @foreach ($atts as $attr)
                  

                      <div class="form-group">
                        <label for="email">{{ $attr->name }}:</label>
                        <?php   
                        $vals= App\AttributesValue::where('attr_id',$attr->id)->where('device',$category->category_name)->get();
                      ?>
                                                 @foreach($vals as $val)

                          <label for="name">{{$val->values}}</label>

                          <input type="checkbox"  name="attr_check[]"  value="{{$val->id}}" checked>
                          @endforeach
                          @endforeach

@endforeach
@endif
                        
                        @if($productattributes->selectval)
                       @foreach($productattributes->selectval as $values)
                       {{$values}}

@endforeach

                        <select name="attr_select[]" id="code" class="form-control">
                          <option value="">--Select--</option>
                          @foreach($categories as $val)
                          <option value="{{$val->id}}">{{$val->category_name}}</option>

                          @endforeach
                          </select>
                         

@endif                      
                      

                        
                          
                          @if($productattributes->details)
                          </br><label>Details</label>

                          @foreach($productattributes->details as $detail)
                          <textarea name="attr_detail[]"  class="form-control" placeholder="" >{{$detail}}</textarea>

                       @endforeach





                        @endif

                        </div>

         </div>

                       
                        
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
      </script>
      
@endsection