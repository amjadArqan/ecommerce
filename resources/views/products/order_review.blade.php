@extends('layouts.frontLayout.front_design')
@section('content')
<section id="form" style="margin-top: 0px;    margin-bottom: 40px;">
	<div class="container">
        <div class="breadcrumbs" >
			<ol class="breadcrumb" style="    margin-bottom: 20px; ">
				  <li><a href="#">Home</a></li>
				  <li class="active">Order Review</li>
				</ol>
		</div>
        <form    class="order_review">
            <div class="row">
 
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <h2>Billing  TO</h2>
                            <input name="billing_name" id="billing_name" value="{{$userDetails->name}}" type="text" disabled />
                            <input name="billing_address" id="billing_address" value="{{$userDetails->address}}"  type="text" disabled />
                            <input name="billing_city" id="billing_city" value="{{$userDetails->city}}"  type="text" disabled/>
                            <input name="billing_state" id="billing_state" value="{{$userDetails->state}}"  type="text" disabled />
                            <input name="billing_country" id="billing_country" value="{{$userDetails->country}}"  type="text" disabled />
                            <input name="billing_pincode" id="billing_pincode" value="{{$userDetails->pincode}}"  type="text" disabled />
                            <input name="billing_mobile" id="billing_mobile" value="{{$userDetails->mobile}}"  type="text" disabled />
                    </div>
                </div>
                <div class="col-sm-1">
                    <h2></h2>
                </div>
                    <div class="col-sm-4">
                        <div class="signup-form">
                            <h2>Shipping To</h2>
                                <input name="shipping_name" id="shipping_name" value="{{$shippingDetails->name}}" />
                                <input name="shipping_address" id="shipping_address" value="{{$shippingDetails->address}}"  type="text" disabled />
                                <input name="shipping_city" id="shipping_city" value="{{$shippingDetails->city}}"   type="text" disabled />
                                <input name="shipping_state" id="shipping_state" value="{{$shippingDetails->state}}"    type="text" disabled />
                                <input name="shipping_country" id="shipping_country" value="{{$shippingDetails->country}}"    type="text" disabled />
                                <input name="shipping_pincode" id="shipping_pincode"  value="{{$shippingDetails->pincode}}"   type="text" disabled />
                                <input name="shipping_mobile" id="shipping_mobile"  value="{{$shippingDetails->mobile}}"  type="text" disabled />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </form>


       
    </div>
	</section>
	

	<section id="cart_items">
		<div class="container">
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
     				<tbody>
					<?php $total_amount = 0 ?>
                        @foreach($user_cart as $cart)
						<tr>
							<td class="cart_product">
								<a href=""><img  style="width:100px;" src="{{ asset('images/backend_images/products/small/'.$cart->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$cart->product_name}}</a></h4>
								<p>{{$cart->product_code}} | {{$cart->size}}</p>
							</td>
							<td class="cart_price">
								<p>${{$cart->price}}</p>
                            </td>
 
							<td class="cart_quantity">
								<div class="cart_quantity_button">
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$cart->quantity}}" autocomplete="off" size="2">
								</div>
                            </td>
                            <td class="cart_total">
								<p class="cart_total_price">${{$cart->price*$cart->quantity}}</p>
							</td>
                            <?php  $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>

                        </tr>
                        @endforeach
                        <tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>$ {{$total_amount}}</td>
                                    </tr>
                                    <tr>
										<td>Shipping Cost (+)</td>
										<td>
                                            @if(!empty(Session::get('couponamount')))
                                               ${{Session::get('couponamount')}}
                                            @else
                                             $ 0
                                            @endif
                                        </td>
									</tr>
									<tr>
										<td>Discount Amount (-)</td>
										<td>
                                            @if(!empty(Session::get('couponamount')))
                                               ${{Session::get('couponamount')}}
                                            @else
                                             $ 0
                                            @endif
                                        </td>
									</tr>
									<tr >
										<td>Grand Total</td>
										<td style="color: #950373;"><strong>$ {{ $grand_total =  $total_amount - Session::get('couponamount') }}</strong></td>										
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
            </div>
            <form name="paymentForm" id="paymentForm" method="post" action="{{url('/place-order')}}">
               @csrf
              <input type="hidden" name="grand_total" value="{{$grand_total}}">
			  <div class="payment-options">
					<span>
						<label><strong>Select Payment Method : <strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="COD" value="COD"><strong> COD </strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="Paypal" value="Paypal" ><strong> Paypal</strong></label>
                    </span>
                    <span style="float:right">
                        <button type="submite" class="btn btn-default" onclick="return selectPaymentMethod()">Place Order</button>
                    </span>
            </div>
           </form>
		</div>
	</section> 

	

@endsection