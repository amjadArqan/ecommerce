@extends('layouts.frontLayout.front_design')
@section('content')
<?php use App\Order; ?>

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanks</li>
				</ol>
			</div>
		</div>
	</section>

	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<h3>YOUR ORDER HAS BEEN PLACED</h3>
				<p>Your order number is {{Session::get('order_id')}} and total payable about in $ {{Session::get('grand_total')}} </p>
				<p> Please make payment by clicking on below Payment Button </p>
				<?php
				 $getOrderDetails = Order::getOrderDetails(Session::get('order_id'));
				 $nameArr = explode(' ',$getOrderDetails->name);
				 $getCountryCode = Order::getCountryCode($getOrderDetails->country);
				 ?>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="Ranaessam95@gmail.com">
					<input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="amount" value="{{Session::get('grand_total')}}">
					<input type="hidden" name="item_number" value="{{Session::get('order_id')}}">
					<input type="hidden" name="first_name" value="{{$nameArr[0]}}">
					<input type="hidden" name="last_name" value="{{$nameArr[1]}}">
					<input type="hidden" name="address1" value="{{$getOrderDetails->address}}">
					<input type="hidden" name="address2" value="">
					<input type="hidden" name="city" value="{{$getOrderDetails->city}}">
					<input type="hidden" name="state" value="{{$getOrderDetails->state}}">
					<input type="hidden" name="zip" value="{{$getOrderDetails->pinecode}}">
					<input type="hidden" name="country" value="{{$getCountryCode->country_code}}">
					<input type="hidden" name="email" value="{{$getOrderDetails->user_email}}">
					<input type="hidden" name="return" value="{{url('paypal/thanks')}}">
					<input type="hidden" name="cancel_return" value="{{url('paypal/cancel')}}">

					<input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
</form>
			</div>

		</div>
	</section>


@endsection
<?php

  Session::forget('grand_total');
  Session::forget('order_id');

?>