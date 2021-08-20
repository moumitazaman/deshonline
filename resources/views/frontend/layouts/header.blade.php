<style>
	.com{
		background: #4FA584;
		color:#ffffff;
		font-size:18px;
		border-radius:50%;
	}

	.btn{
		
				background: #345B2C;
		color:#ffffff;
		
	}
	.comp{
		padding: .35rem .65rem;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: .2rem;
	box-shadow:0 0 0 0.2rem rgba(134,142,150,.5)
	}
	/*.logohead{
		width:1349px !important;
		padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
	}*/
	.product_panel{
		margin-top:10px;
	}
	</style>

<div class="header_main">
<div class="container">

				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
													<div class="logo"><a href="{{ url('/') }}"><img  class="img-responsive"  src="{{ asset('frontend/images/logo.jpg')}}"/></a></div>

						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="{{route('show.search')}}" class="header_search_form clearfix" method="POST">
									{{ csrf_field() }}

										<input type="search" name="keyword"  required="required" class="header_search_input" placeholder="Search for products...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
												@foreach ($categories  as $key => $category)    

													<li data-category="{{$category->id}}"><a class="clc" href="#">{{$category->category_name}}</a><input type="hidden" value="" class="cat" name="category">
</li>
													@endforeach
												</ul>
												
												
												
											</div>
										</div>
										<button type="submit"  class="header_search_button trans_300" value="Submit"><img src="{{ asset('frontend/images/search.png')}}" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								
							
							<!--<form id="cpform" method="POST" action="{{route('cart.compare')}}" onsubmit="target_popup(this)">
                                        {{ csrf_field() }}
                                        <input type="hidden"  id="cpid" name="cpid">
												<button type="submit"  id="cp" class="btn pointer com btn-sm  active" class="tooltip-test" title="Compare">
												<i class="fa fa-balance-scale" aria-hidden="true"></i>
            <span class="compare"></span>
                                                </button>
												</form>-->
							
							
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
									<a href="{{url('/cart')}}">	<img src="{{ asset('frontend/images/cart.png')}}" alt=""></a>
										<div class="cart_count"><span id="cartcount">{{$cartCount}}</span><span id="cart_value"></span>
</div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{url('/cart')}}">Cart</a></div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	

<script>
	$(".custom_list li").click(function() {
		$(this).addClass("clicked");
		var category=$(".clicked").data("category");

		$(".custom_list .cat").val(category);


}); 
	 

	
	
function Search(form) {
	var category=$(".clicked").data("category");
	
var keyword=$("#keyword").val();

$.ajax({
 headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},  
type:"POST",
url: "{{url('/search')}}",
data:{'category':category,'keyword':keyword},

success:function(data){


	


  
},
error:function(error){
 console.log(error)
 alert("not send");
},


});


}
	</script>