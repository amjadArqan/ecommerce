<?php 
use App\Http\Controllers\Controller;
$maincategories = Controller::mainCategories();

?>

<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +0597513757</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> defacto@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{url('/')}}"><img src="{{asset('images/frontend_images/home/logo.png')}}" style="height: 45px;" alt="" /></a>
						</div>

					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								@if(empty(Auth::check()))
								<li><a href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>

								  <li><a href="{{url('/login-register')}}"><i class="fa fa-lock"></i> Login</a></li>
								@else
								    <li><a href="{{url('/orders')}}"><i class="fa fa-crosshairs"></i> Orders</a></li>
								    <li><a href="{{url('/account')}}"><i class="fa fa-user"></i> Account</a></li>
								    <li><a href="{{url('/user-logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>

                                @endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{url('/')}}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									@foreach($maincategories as $cat)
									@if($cat->status == "1")

									     <li><a href="{{asset('products/'.$cat->url)}}">{{$cat->name}}</a></li>
										 @endif
									@endforeach
                                    </ul>
                                </li> 

								<li><a href="{{url('404')}}">404</a></li>
								<li><a href="{{url('page/contact')}}">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
						<form action="{{url('/search-products')}}" method="post">
						    @csrf
							<input type="text" placeholder="Search Product" name="product"/>
							<button type="submit" style="border: 0px;height: 35px;margin-left: -3px;padding-bottom: 4px;background-color: #950373;color: #FFF;">Go</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->