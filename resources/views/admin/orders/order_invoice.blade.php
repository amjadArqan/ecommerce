<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # {{$oderDetails->id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
                        {{$userDetails->name}}<br>
                        {{$userDetails->address}}<br>
                        {{$userDetails->city}}<br>
                        {{$userDetails->state}}<br>
                        {{$userDetails->pincode}}<br>
                        {{$userDetails->country}}<br>
                        {{$userDetails->mobile}}<br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
                        {{$oderDetails->name}}<br>
                        {{$oderDetails->address}}<br>
                        {{$oderDetails->city}}<br>
                        {{$oderDetails->state}}<br>
                        {{$oderDetails->pinecode}}<br>
                        {{$oderDetails->country}}<br>
                        {{$oderDetails->mobile}}<br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{$oderDetails->payment_method}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{$oderDetails->created_at}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td class="text-left"><strong>Order Code</strong></td>
        							<td class="text-left"><strong>Size</strong></td>
                                    <td class="text-left"><strong>Color</strong></td>
        							<td class="text-left"><strong>Price</strong></td>
                                    <td class="text-left"><strong>Qty</strong></td>
                                    <td class="text-left"><strong>Totals</strong></td>

                                </tr>
    						</thead>
    						<tbody>
                            <?php  $subtotal = 0?>
                               @foreach($oderDetails->orders as $pro)
                                    <tr>
                                        <td class="text-left">{{$pro->product_code}}</td>
                                        <td class="text-left">{{$pro->product_size}}</td>
                                        <td class="text-left">{{$pro->product_color}}</td>
                                        <td class="text-left">USD {{$pro->product_price}}</td>
                                        <td class="text-left">{{$pro->product_qty}}</td>
                                        <td class="text-left">USD {{ $pro->product_price * $pro->product_qty }}</td>

                                    </tr>
                                    <?php  $subtotal = $subtotal + ($pro->product_price * $pro->product_qty)?>

                                @endforeach

    							<tr>
                                
                                    <td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>

    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right"><?php echo $subtotal ?></td>
    							</tr>
    							<tr>
                                    <td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>

    								<td class="no-line text-center"><strong>Shipping Charges (+)</strong></td>
    								<td class="no-line text-right">USD 0</td>
    							</tr>
                                <tr>
                                    <td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>

    								<td class="no-line text-center"><strong>Coupon Discount (-)</strong></td>
    								<td class="no-line text-right">USD 0</td>
    							</tr>
    							<tr>
                                    <td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>

    								<td class="no-line text-center"><strong>Grand Total</strong></td>
    								<td class="no-line text-right">{{ $oderDetails->grand_total }}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>