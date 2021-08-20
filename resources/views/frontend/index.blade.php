@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">


    <!-- Content Wrapper -->
    
	<div class="banner">
		<div class="banner_background" style="background-image:url({{ asset('frontend/images/banner_background.jpg')}}"></div>
		<div class="container fill_height">
			<div class="row fill_height">
				<div class="banner_product_image"><img src="{{ asset('frontend/images/banner_product.png')}}" alt=""></div>
				<div class="col-lg-5 offset-lg-4 fill_height">
					<div class="banner_content">
						<h1 class="banner_text">new era of smartphones</h1>
						<div class="banner_price"><span>$530</span>$460</div>
						<div class="banner_product_name">Apple Iphone 6s</div>
						<div class="button banner_button"><a href="#">Shop Now</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="popular_categories">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="popular_categories_content">
						<!-- <div class="popular_categories_title">Popular Categories</div>
						<div class="popular_categories_slider_nav">
							<div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
						<div class="popular_categories_link"><a href="#">full catalog</a></div>
					</div>-->
				</div>
				

				<div class="col-lg-9">
					<div class="popular_categories_slider_container">
						<!-- <div class="owl-carousel owl-theme popular_categories_slider">
						@foreach ($categories as $key => $category)    

							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="<?php echo asset('/').'uploads/icon/'.$category->icon; ?>" alt=""></div>
									<div class="popular_category_text">{{$category->category_name}} </div>
								</div>
							</div>

							@endforeach

						</div>-->
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
		$settings=App\Settings::where('id',1)->first();


				?>
			


	<div class="deals_featured">
		<div class="container">
			<div class="row">
			    <div style="text-transform:uppercase; margin: 0 auto; color: #a19a9a; text-align:center">
			<h2>Our Products</h2>
			</div>
			<div class="mobile_display" style="padding-left: 70px;text-align:center;width: 85%;">
			@foreach($products as $pro)
                        <div class="col-lg-4">
                            <div class="card" style="margin-bottom: 20px; height: auto;">
                                <img src="<?php echo asset('/').'uploads/'.$pro->img_name ?>"
                                     class="card-img-top mx-auto"
                                     style="height: 150px; width: 150px;display: block;"
                                     alt="product"
                                >
                                <div class="card-body">
                                    <a href=""><h6 class="card-title">{{ $pro->product_name }}</h6></a>
                                    <p>{{$settings->currency}}{{ $pro->price }}</p>
                                    <form class="send-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $pro->id }}"  name="pid">
                                        <input type="hidden" value="{{ $pro->product_name }}" id="name" name="name">
                                        <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ $pro->img_name }}" id="img" name="img">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <div class="card-footer d-flex justify-content-center" style="background-color: white;">
                                              <div class="row">
                                                 <?php if($pro->quantity==0){?>
													<button type="button" data-id="{{$pro->id}}"  class="pointer btn btn-secondary btn-sm  active" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-frown"></i>Out of Stock
												</button>
                                               
												  <?php }else{?>
													<button type="button" data-id="{{$pro->id}}"  onclick="myFunc(this.form)"  class="pointer btn  btn-sm  active" class="tooltip-test" title="add to cart">
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
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start mobile_off" >
					
					<!-- Deals -->
    
                      <div class="deals" style="box-shadow:none; width:5%;">
						<div>
						<div class="shop_sidebar">

						<div class="sidebar_section filter_by_section">
							
						</div>
					</div>
						</div>

						
					</div>
					
					<!-- Featured -->
					<div class="featured">
						<div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active">
</li>
									
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>

							<!-- Product Panel -->
							<div class="product_panel panel active">
								<div class="featured_slider slider">
									<!-- Slider Item -->
									@foreach ($products as $key => $product)    

									<!-- Slider Item -->
									<div class="featured_slider_item">
										<div class="border_active"></div>
										<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
										<?php
										$category=App\Category::where('id',$product->category_id)->first();

										$brand=App\Brand::where('id',$product->brand_id)->first();

										?>
									<a href="{{route('single.singleProduct', $product->id)}}">	
										<!--<a data-id="{{$product->id}}"  data-brand="{{ $brand->brand_name }}" data-category="{{ $category->category_name }}" data-price="{{ $product->price }}" data-product_name="{{ $product->product_name }}" data-image="{{$product->img_name}}" data-toggle="modal" data-target="#modalQuickView" class="user_dialog">-->
											<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="<?php echo asset('/').'uploads/'.$product->img_name ?>" alt=""></div>
											<div class="product_content">
												<div class="product_price">{{$settings->currency}}{{ $product->price }}</div>
												<div class="product_name"><h4>{{ $product->product_name }}</h4></div>
											</a>
												<div class="product_extras">
  
												{{ session()->get('success_msg') }}
												<form class="sendform">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $product->id }}" id="id" name="pid">
                                        <input type="hidden" value="{{ $product->product_name }}" id="name" name="name">
                                        <input type="hidden" value="{{ $product->price }}" id="price" name="price">
                                        <input type="hidden" value="{{ $product->img_name }}" id="img" name="img">
                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                        <div class="card-footer d-flex justify-content-center" style="background-color: white;">
                                              <div class="row">
                                                <?php if($product->quantity==0){?>
													<button type="button" data-id="{{$product->id}}"  class="pointer btn btn-secondary btn-sm  active" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-frown"></i>Out of Stock
												</button>
                                               
												  <?php }else{?>
													<button type="button" data-id="{{$product->id}}"  onclick="myFunc(this.form)"  class="pointer btn  btn-sm  active" class="tooltip-test" title="add to cart">
                                                    <i class="fa fa-shopping-cart"></i> Add to Cart
												</button>
													
												  <?php }?>
												</form>
												
                                            </div>
                                        </div>
                                   
													
												</div>
											</div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">new</li>
											</ul>
										</div>
									</div>
									

									@endforeach



								</div>
							</div>

							
								

									
											
								

								


									

								

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	

	<!-- Banner -->


	<!-- Brands -->

	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="brands_slider_container">
						
						<!-- Brands Slider -->

						<div class="owl-carousel owl-theme brands_slider">
							
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset('frontend/images/brands_1.jpg')}}"alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset('frontend/images/brands_2.jpg')}}"alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset('frontend/images/brands_3.jpg')}}"alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset('frontend/images/brands_4.jpg')}}"alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset('frontend/images/brands_5.jpg')}}"alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset('frontend/images/brands_6.jpg')}}"alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset('frontend/images/brands_7.jpg')}}"alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset('frontend/images/brands_8.jpg')}}"alt=""></div></div>

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

							<div class="newsletter_icon"><img src="{{ asset('frontend/images/send.png')}}" alt=""></div>
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
	
<!-- Modal: modalQuickView -->
<div class="modal animated zoomIn" id="modalQuickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-5">
            <!--Carousel Wrapper-->
           
			<img src="" class="proimage" />

            
            <!--/.Carousel Wrapper-->
          </div>
          <div class="col-lg-7">
		  <form>
            <h2 class="h2-responsive product-name">
              <strong>		  <input type="text" name="name" class="product_name" value=""/><br>
</strong>
            </h2>
            <h4 class="h4-responsive">
              <span class="green-text">
                <strong>		  $<input type="text" name="price" class="price" value=""/>
</strong>
<input type="hidden" value="" class="proid" name="pid">

<input type="hidden" value="1" id="quantity" name="quantity">

              </span>
              <!--<span class="grey-text">
                <small>
                  <s>$89</s>
                </small>
              </span>-->
            </h4>
			
			<h4 class="h4-responsive">
                <strong>		  <input type="text" name="category" class="category" value=""/>
</strong>
              
            </h4>
			<h5 class="h5-responsive">
                <strong>		  <input type="text" name="brand" class="brand" value=""/>
</strong>
              
            </h5>

            <!--Accordion wrapper-->
            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

              <!-- Accordion card 
              <div class="card">

                <div class="card-header" role="tab" id="headingOne1">
                  <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                    aria-controls="collapseOne1">
                    <h5 class="mb-0">
                      Collapsible Group Item #1 <i class="fas fa-angle-down rotate-icon"></i>
                    </h5>
                  </a>
                </div>-->

                <!-- Card body -->
               <!-- <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                  data-parent="#accordionEx">
                  <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                    squid. 3
                    wolf moon officia aute,
                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                  </div>
                </div>

              </div>-->
              <!-- Accordion card -->

              <!-- Accordion card -->
              <div class="card">

                <!-- Card header -->
                

                
                </div>

              </div>
              <!-- Accordion card -->

              <!-- Accordion card -->
              <div class="card">

                
               

              </div>
              <!-- Accordion card -->

            </div>
            <!-- Accordion wrapper -->


            <!-- Add to Cart -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">

                  <!--<select class="md-form mdb-select colorful-select dropdown-primary">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">White</option>
                    <option value="2">Black</option>
                    <option value="3">Pink</option>
                  </select>
                  <label>Select color</label>-->

                </div>
                <div class="col-md-6">

                  <!--<select class="md-form mdb-select colorful-select dropdown-primary">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">XS</option>
                    <option value="2">S</option>
                    <option value="3">L</option>
                  </select>
                  <label>Select size</label>-->

                </div>
              </div>
              <div class="text-center">

                <button type="button" class="btn btn-secondary pointer" data-dismiss="modal">Close</button>
                <button type="button" onclick="myFunc(this.form)" class="btn btn-primary pointer">Add to cart
                  <i class="fas fa-cart-plus ml-2" aria-hidden="true"></i>
                </button>
              </div>
            </div>
            <!-- /.Add to Cart -->
			</form>
          </div>
        </div>
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
	.pointer {
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
	</style>
	
    
@endsection