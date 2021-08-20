@extends('frontend.layouts.app')

@section('title', 'Single Page')

@section('content')
    <!-- Single Product -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css')}}">
<link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">


<?php 
		$settings=App\Settings::where('id',1)->first();


				?>

	<div class="single_product">
		<div class="container">
			<div class="row">

				<!-- Images -->
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

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected"><img src="<?php echo asset('/').'uploads/'.$product->img_name ?>" alt=""></div>
				</div>
                <?php
										$category=App\Category::where('id',$product->category_id)->first();

										$brand=App\Brand::where('id',$product->brand_id)->first();

										?>
				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
						<div class="product_category">{{ $category->category_name }}</div>
						<div class="product_name">{{ $product->product_name }}</div>
						<div class="product_text"><p>{{ $product->details }}</p></div>
                        <div class="order_info d-flex flex-row">
								

								</div>

								<div class="product_price">{{$settings->currency}}{{ $product->price }}</div>
								<div class="button_container">
                                <form class="sendform">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $product->id }}" id="id" name="pid">
                                        <input type="hidden" value="{{ $product->product_name }}" id="name" name="name">
                                        <input type="hidden" value="{{ $product->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ $product->img_name }}" id="img" name="img">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
										<?php if($product->quantity==0){?>
													<button type="button" data-id="{{$product->id}}"  class="pointer btn btn-secondary btn-sm  active" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-frown"></i>Out of Stock
												</button>
                                               
												  <?php }else{?>
													<button type="button" data-id="{{$product->id}}"  onclick="myFunc(this.form)"  class="pointer btn btn-secondary btn-sm  active" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> Add to Cart
												</button>
													
												  <?php }?>
												</form>
								</div>
								
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Brands -->

	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="brands_slider_container">
						
						<!-- Brands Slider -->

						<div class="owl-carousel owl-theme brands_slider">
							
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_1.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_2.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_3.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_4.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_5.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_6.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_7.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_8.jpg" alt=""></div></div>

						</div>
						
						<!-- Brands Slider Navigation -->
						<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/js/product_custom.js')}}"></script>

    <!-- Footer -->
    <script>
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
        </script>

    @endsection


    @section('scripts')
    
    @endsection