@extends('layouts.frontLayout.front_design')
@section('content')
<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
						@foreach($banners as $key =>  $banner)
							<div class="item  @if($key ==0 ) active @endif">
								<div class="col-sm-6">
									<h1><span>D</span>efacto</h1>
									<h1 class="matgintop">{{$banner->title}}</h1>
									<p>{{$banner->description}}</p>
								</div>
								<div class="col-sm-6">
									<img src="{{ asset('images/backend_images/banners/'.$banner->image)}}"  class="girl img-responsive" alt="" />
								</div>
							</div>
						@endforeach($banners as @banner)
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					 @include('layouts.frontLayout.front_sidebar')
</div>
				 <div class="col-sm-9">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">All Items</h2>
					   	@foreach($productAll as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{ asset('images/backend_images/products/large/'.$product->image)}}" alt="" />
											<h2>$ {{$product->price}}</h2>
											<p>{{$product->product_name}}</p>
											<a href="{{url('product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>

								</div>
							</div>
						</div>
						@endforeach
						<div align="center">{{$productAll->links()}} </div>
					</div><!--features_items-->
				</div>
			</div>
		</div>
    </section>

@endsection

