@extends('frontend.layouts.app')

@section('title', 'Shop')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css')}}">
<link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">
<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>

<?php 
		$settings=App\Settings::where('id',1)->first();


				?>

    <div class="container" style="margin-top: 20px">
        
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Products In Our Store</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($products as $pro)

                        <div class="col-lg-3">
                        <a href="{{route('single.singleProduct', $pro->id)}}">	

                            <div class="card" style="margin-bottom: 20px; height: auto;">
                                <img src="<?php echo asset('/').'uploads/'.$pro->img_name ?>"
                                     class="card-img-top mx-auto"
                                     style="height: 150px; width: 150px;display: block;"
                                     alt="{{ $pro->image_path }}"
                                >
                                <div class="card-body">
                                    <a href="{{route('single.singleProduct', $pro->id)}}"><h6 class="card-title">{{ $pro->product_name }}</h6></a>
                                    <p>{{$settings->currency}}{{ $pro->price }}</p>
                                    </a>
                                    <form class="send-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $pro->id }}"  name="pid">
                                        <input type="hidden" value="{{ $pro->product_name }}" id="name" name="name">
                                        <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ $pro->img_name }}" id="img" name="img">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <div class="card-footer" style="background-color: white;">
                                              <div class="row">
                                              <?php if($pro->quantity==0){?>
													<button type="button" data-id="{{$pro->id}}"  class="pointer btn btn-secondary btn-sm  active" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-frown"></i>Out of Stock
												</button>
                                               
												  <?php }else{?>
													<button type="button" data-id="{{$pro->id}}"  onclick="myFunc(this.form)"  class="pointer btn btn-sm  active" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> Add to Cart
												</button>
													
												  <?php }?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('frontend/js/velocity.min.js') }}"></script>



    <script>
	function target_popup(form) {
    window.open('', 'formpopup', 'width=1200,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}

$('#cart_value').hide(200);

	
	
	function myFunc(form) {
var j=0;
$.ajax({
	 headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},  
   type:"POST",
   url: "{{route('cart.add')}}",
   data:$(form).serializeArray(),

   success:function(data){
	Swal.fire({
        text: 'Product Added',
		type: 'success',
		timer: 2000,
		showCancelButton: false,
  showConfirmButton: false
        
      })
	  
		$('#cart_value').text(data.cartCount);
		$('#cartcount').hide(200);
		$('#cart_value').show(300);


	  
   },
   error:function(error){
	 console.log(error)
	 alert("not send");
   },

   
 });
 e.preventDefault();


}

   
                  
				
				


				
$(function () {
                    
                    var id = $(this).data("id");
                    
                    var fieldArray = [];
    $( ".comp" ).click(function(){
		var $this = $(this);
   var clickCounter = $this.data('clickCounter') || 0;
   // here you know how many clicks have happened before the current one

   clickCounter += 1;
   $this.data('clickCounter', clickCounter);
   
		if(clickCounter>1){
			Swal.fire({
        text: 'Already Added to Compare',
		type: 'success',
		timer: 2000,
		showCancelButton: false,
  showConfirmButton: false
        
      })

		}
		else{

			fieldArray.push($(this).data("id"));
		var compare=fieldArray.length;
		$('.compare').html(compare);
		$('#cpid').val(fieldArray);

		}
        

		
              
                      
                    });


		});

		
/*function compFunc() {

$.ajax({
 headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},  
type:"POST",
url: "{{route('cart.compare')}}",
data:$('#cpform').serializeArray(),


				});
				}


		$("#cp").click(function(e){
                    e.preventDefault();
                    $.ajax({
                        headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },  
                      type:"POST",
                      url: "{{ url('/compare')}}",
                      data: $("#cpform").serializeArray(),
                      success:function(response){
						
						$("#getModal").show();

                        
                      },
                      error:function(error){
                        console.log(error)
                        alert("not send");
                      },
              
                      
                    });
                  
				});
                  */
           
    </script>
	<!-- Button trigger modal-->



      
<script>
$(document).on("click", ".user_dialog", function () {
     var Userid = $(this).data('id');
	 var product_name=$(this).data('product_name');
	 var imgsrc="<?php echo asset('/').'uploads/';?>"+$(this).data('image');
     var price = $(this).data('price');
	 var category = $(this).data('category');
     var brand = $(this).data('brand');


	
	 
     $(".modal-body .proid").val( Userid );
	 $(".modal-body .product_name").val(product_name );
	 $('.modal-body .proimage').attr('src',imgsrc);
	 $(".modal-body .price").val(price);
	 $(".modal-body .category").val(category);

	 $(".modal-body .brand").val(brand);



});

</script>
<style>
	.user_dialog{
		cursor:pointer;
	}
	input{
		border:none;
	}
	a:focus { outline: none; }
	.proimage{
		width:300px;
		height:300px;
	}
    .pointer{
        cursor:pointer;
    }
	</style>
	@endsection