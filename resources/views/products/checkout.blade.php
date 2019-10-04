@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top: 0px;">
	<div class="container">
    <div class="breadcrumbs">
    <ol class="breadcrumb" style="    margin-bottom: 20px;">

				  <li><a href="#">Home</a></li>
				  <li class="active">Checkout</li>
				</ol>
			</div>
    @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-block" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('flash_message_error')}}
                    </div>
                @endif  
                @if(Session::has('flash_message_Success'))
                    <div class="alert alert-success alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('flash_message_Success')}}
                    </div>
                @endif  
        <form method="post" action="{{url('/checkout')}}" class="checkoutForm">
            @csrf
            <div class="row">
 
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <h2>Bill TO</h2>
                            <input name="billing_name" id="billing_name" @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif type="text" placeholder="Billing Name" />
                            <input name="billing_address" id="billing_address" @if(!empty($userDetails->address)) value="{{$userDetails->address}}"  @endif   type="text" placeholder="Billing Address" />
                            <input name="billing_city" id="billing_city" @if(!empty($userDetails->city)) value="{{$userDetails->city}}"  @endif   type="text" placeholder="Billing City" />
                            <input name="billing_state" id="billing_state" @if(!empty($userDetails->state))  value="{{$userDetails->state}}"   @endif  type="text" placeholder="Billing State" />
                            <select id="billing_country" name="billing_country" style="padding: 12px 10px;margin-bottom: 12px;">
								<option value="">Select Country</option>
								@foreach($countries as $country)
									<option value="{{$country->country_name}}" @if (!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif >{{$country->country_name}}</option>
								@endforeach
							</select>
                            <input name="billing_pincode" id="billing_pincode" @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif  type="text" placeholder="Billing Pincode" />
                            <input name="billing_mobile" id="billing_mobile"   @if(!empty($shippingDetails->mobile)) value="{{$userDetails->mobile}}"  @endif   type="text" placeholder="Billing Mobile" />
                            <input type="checkbox" id="billtoship" style="height: 12px; width: 15px;display:inline">
                            <label for="billtoship">Shipping Address Same As Billing Address</label>

                    </div>
                </div>
                <div class="col-sm-1">
                    <h2></h2>
                </div>
                    <div class="col-sm-4">
                        <div class="signup-form">
                            <h2>Ship To</h2>
                                <input name="shipping_name" id="shipping_name"  @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif    placeholder="Shipping  Name" />
                                <input name="shipping_address" id="shipping_address" @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}"  @endif     type="text" placeholder="Shipping  Address" />
                                <input name="shipping_city" id="shipping_city"  @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}"  @endif    type="text" placeholder="Shipping  City" />
                                <input name="shipping_state" id="shipping_state" @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}"  @endif     type="text" placeholder="Shipping  State" />
                                <select id="shipping_country" name="shipping_country"  style="padding: 12px 10px;margin-bottom: 12px;">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option  value="{{$country->country_name}}"  @if(!empty($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif >{{$country->country_name}}</option>
                                    @endforeach
							    </select>
                                <input name="shipping_pincode" id="shipping_pincode" @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}"  @endif       type="text" placeholder="Shipping  Pincode" />
                                <input name="shipping_mobile" id="shipping_mobile"  @if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}"  @endif   type="text" placeholder="Shipping  Mobile" />
                                <button type="submit" class="btn btn-default">Check out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </form>
    </div>
	</section>
	



@endsection