<style>

</style>
		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="main_nav_content d-flex flex-row">

							<!-- Categories Menu -->

							<div class="cat_menu_container">
								<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
									<div class="cat_burger"><span></span><span></span><span></span></div>
									<div class="cat_menu_text">categories</div>
								</div>

								<ul class="cat_menu">
								@foreach ($categories as $key => $category)    
									
									<?php
								$subcategories = App\SubCategory::where('category_id',$category->id)->get();
									?>
									@if($subcategories)	

			<li class="hassubs"><a href="{{ route('category.show', $category->id) }}">{{$category->category_name}} <i class="fas fa-chevron-right ml-auto"></i></a>
		
			<ul>
			@foreach ($subcategories as $key => $cat)    

											
											<li><a href="{{ route('subcategory.show', $cat->id) }}">{{$cat->sub_category_name}}<i class="fas fa-chevron-right"></i></a></li>
										@endforeach
										</ul>
		
		
		</li>
		

@endif

									
									@endforeach
									

								</ul>
								

								

								
							</div>
												
							


							
							

							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
									<li><a href="{{url('/')}}">Home<i class="fas fa-chevron-down"></i></a></li>
								
									
									
									<li><a href="{{route('shop.index')}}">All Products<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="#">Contact Us<i class="fas fa-chevron-down"></i></a></li>
								</ul>
							</div>

							<div class="menu_trigger_container ml-auto">
								<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
									<div class="menu_burger">
										<div class="menu_trigger_text">menu</div>
										<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</nav>
		
		<!-- Menu -->

		<div class="page_menu">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="page_menu_content">
							
							<div class="page_menu_search">
							<form action="{{route('show.search')}}" class="header_search_form clearfix" method="POST">
									{{ csrf_field() }}

										<input type="search" name="keyword"  required="required" class="page_menu_search_input" placeholder="Search for products...">
								</form>
							
							</div>
							<ul class="page_menu_nav">
								
								
								<li class="page_menu_item">
									<a href="{{url('/')}}">Home<i class="fa fa-angle-down"></i></a>
								</li>
								
									
								
								<li class="page_menu_item"><a href="{{route('shop.index')}}">All Products<i class="fa fa-angle-down"></i></a></li>
								<li class="page_menu_item"><a href="#">Contact Us<i class="fa fa-angle-down"></i></a></li>
								@if (Route::has('login'))
                            
							@auth	
							@if(Auth::user()->role_id==1 || Auth::user()->role_id==2 || Auth::user()->role_id==3)
							<li class="page_menu_item"><a href="{{ route('backend.dashboard') }}" v-pre>
								
							
                                    Dashboard
                                </a>
                                </li>
@endif
<div class="user_icon"><img src="{{ asset('frontend/images/user.svg')}}" alt=""></div>

<li class="page_menu_item"><a href="#" v-pre>
								
							
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </a>
                                </li>
								<li class="page_menu_item">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
								@else
								<li class="page_menu_item"><a href="{{ url('/login') }}">Sign in</a><a href="{{ url('/adminregisterform') }}">Want to become a Seller?</a></li>
								



								@endauth
								@endif
							</ul>
							
							<div class="menu_contact">
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="images/phone_white.png" alt=""></div>{{$settings->phone}}</div>
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="images/mail_white.png" alt=""></div><a href="mailto:{{$settings->email}}">{{$settings->email}}</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>