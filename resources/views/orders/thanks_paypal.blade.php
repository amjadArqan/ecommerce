@extends('layouts.frontLayout.front_design')
@section('content')


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
				<h3>YOUR PAYPAL ORDER HAS BEEN PLACED</h3>
                <p>Thanks for paymen. we  Will Process Your Order Very Soon</p>
				<p>Your order number is {{Session::get('order_id')}} and total amount paid in $ {{Session::get('grand_total')}} </p>
			</div>

		</div>
	</section>


@endsection
<?php
  Session::forget('grand_total');
  Session::forget('order_id');

?>