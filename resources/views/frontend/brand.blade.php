@extends('frontend.layouts.app-cart')

@section('title', 'Brand Page')

@section('content')
<link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php 
		$settings=App\Settings::where('id',1)->first();


				?>

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">{{$brand_name}}</h2>
		</div>
	</div>

	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Categories</div>
							<ul class="sidebar_categories">
                            @foreach ($allcategory as $key => $allcat)    

								<li><a href="{{ route('category.show', $allcat->id) }}">{{$allcat->category_name}}</a></li>
								@endforeach
							</ul>
						</div>
						<div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle color_subtitle">Price Range:</div>
							<div class="slider-box">
  <form  action="{{route('price.filter')}}" method="POST">
  {{ csrf_field() }}

  <input type="text" id="priceRange"  readonly value="">
  <input type="hidden" id="amount1" name="min_price" value="">
    <input type="hidden" id="amount2" name="max_price" value="">
  <div id="price-range" class="slider"></div>
  <div style="margin-top:10px;">
  <input class="btn btn-default pointer" type="submit" value="Filter">
  </div>

  </form>
  </div>
						</div>
						<!--<div class="sidebar_section">
							<div class="sidebar_subtitle color_subtitle">Color</div>
							<ul class="colors_list">
								<li class="color"><a href="#" style="background: #b19c83;"></a></li>
								<li class="color"><a href="#" style="background: #000000;"></a></li>
								<li class="color"><a href="#" style="background: #999999;"></a></li>
								<li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
								<li class="color"><a href="#" style="background: #df3b3b;"></a></li>
								<li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
							</ul>
						</div>-->
						<div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Brands</div>
							<ul class="brands_list">
                            @foreach ($brands as $key => $brand)    

								<li class="brand"><a href="{{route('brand.showBrand',$brand->id)}}">{{$brand->brand_name}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>

				</div>

				<div class="col-lg-9">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{$procount}}</span> products found</div>
							<div class="shop_sorting">
								
							</div>
						</div>

						<div class="row">
                    @foreach($products as $pro)

                        <div class="col-lg-3">
                        <a href="{{route('single.singleProduct', $pro->id)}}">	

                            <div class="card zhov" style="margin-bottom: 20px; height: auto;">
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
													<button type="button" data-id="{{$pro->id}}"  onclick="myFunc(this.form)"  class="pointer cart-btn btn  btn-sm  active" class="tooltip-test" title="add to cart">
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
										
										
									

						<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row">
							
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title"></h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">
						
						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">
							
							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_1.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225<span>$300</span></div>
										<div class="viewed_name"><a href="#">Beoplay H7</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_2.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$379</div>
										<div class="viewed_name"><a href="#">LUNA Smartphone</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_3.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225</div>
										<div class="viewed_name"><a href="#">Samsung J730F...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_4.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$379</div>
										<div class="viewed_name"><a href="#">Huawei MediaPad...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_5.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225<span>$300</span></div>
										<div class="viewed_name"><a href="#">Sony PS4 Slim</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_6.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$375</div>
										<div class="viewed_name"><a href="#">Speedlink...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
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
	
    <!-- Footer -->
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js')}}"></script>

    <script src="{{ asset('frontend/js/shop_custom.js')}}"></script>
    


    <script>
	$(function() {
  $("#price-range").slider({range: true, min: 0, max: 1000, values: [0, 1000], 
  slide: function(event, ui) {$("#priceRange").val("$" + ui.values[0] + " - $" + ui.values[1]);
	$( "#amount1" ).val(ui.values[ 0 ]);
        $( "#amount2" ).val(ui.values[ 1 ]);
  }
  });
  $("#priceRange").val("$" + $("#price-range").slider("values", 0) + " - $" + $("#price-range").slider("values", 1));
  
});


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
    </script>
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
	.user_dialog, .pointer{
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
	.zhov{
	transition: transform .2s;
}
.zhov:hover{
	padding:10px;
	box-shadow: 10px 10px 5px #aaaaaa;
	transform:scale(1.15);
}
	</style>

	@endsection


@section('scripts')

@endsection