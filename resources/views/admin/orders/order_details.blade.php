@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">

  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Widgets</a> </div>
    <h1>Widgets</h1>
  </div>
  <div class="container-fluid">
  @if(Session::has('flash_message_error'))

<div class="alert alert-error alert-block" role="alert">
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
    <hr>
    <div class="row-fluid">
       <div class="span6">
            <div class="widget-box">
                <div class="widget-title">
                   <h5>Order Details</h5>
                </div>
                <div class="widget-content nopadding">
                  <table class="table table-striped table-bordered">
                     <tbody>
                     <tr>
                  <td class="taskDesc">Order Date</td>
                  <td class="taskStatus">{{$oderDetails->created_at}}</span></td>
                    </tr>
                    <tr>
                      <td class="taskDesc">Order Status</td>
                      <td class="taskStatus">{{$oderDetails->order_status}}</td>
                    </tr>
                    <tr>
                      <td class="taskDesc">Order Total</td>
                      <td class="taskStatus">USD {{$oderDetails->grand_total}}</td>
                    </tr>
                    <tr>
                      <td class="taskDesc">Shipping Charges</td>
                      <td class="taskStatus">USD {{$oderDetails->shipping_charges}}</td>
                    </tr>
                    <tr>
                      <td class="taskDesc">Coupon Code</td>
                      <td class="taskStatus">{{$oderDetails->coupon_code}}</td>
                    </tr> 
                    <tr>
                      <td class="taskDesc">Coupon Amount</td>
                      <td class="taskStatus">USD {{$oderDetails->coupon_amount}}</td>
                    </tr> 
                    <tr>
                      <td class="taskDesc">Payment Method</td>
                      <td class="taskStatus">{{$oderDetails->payment_method}}</td>
                    </tr> 
              </tbody>
            </table>
          </div>
        </div>
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> 
                <h5>Shipping Address</h5>
          </div>
              </div>
              <div class="collapse in accordion-body" id="collapseGOne">
                <div class="widget-content">
                  {{$oderDetails->name}}<br>
                  {{$oderDetails->address}}<br>
                  {{$oderDetails->city}}<br>
                  {{$oderDetails->state}}<br>
                  {{$oderDetails->pinecode}}<br>
                  {{$oderDetails->country}}<br>
                  {{$oderDetails->mobile}}<br>
                </div>
              </div>
            </div>

          </div>

      </div>

      
      <div class="span6">
      <div class="widget-box">
          <div class="widget-title">
            <h5>Customer Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <td class="taskDesc">Customer Name</td>
                  <td class="taskStatus">{{$oderDetails->name}}</span></td>
                </tr>
                <tr>
                  <td class="taskDesc">Customer Email</td>
                  <td class="taskStatus">{{$oderDetails->user_email}}</td>
                </tr>
               
              </tbody>
            </table>
          </div>
        </div>
        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> 
                  <h5>Update Order Status Address</h5>
              </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
                <div class="widget-content"> 
                  <form action="{{url('admin/update-order-status')}}" method="post">
                  @csrf
                  <input type="hidden" name="order_id" value="{{ $oderDetails->id }}">
                    <table width="100%">
                        <tr>
                          <td>
                            <select name="order_status" id="order_status" class="control-lable" required>
                              <option value="New" @if ( $oderDetails->order_status == "New") selected @endif >New<option>
                              <option value="Pending" @if ( $oderDetails->order_status == "Pending") selected @endif  >Pending<option>
                              <option value="In Process"  @if ( $oderDetails->order_status == "In Process") selected @endif >In Process<option>
                              <option value="Cancelled" @if ( $oderDetails->order_status == "Cancelled") selected @endif >Cancelled<option>

                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <input type="submit" value="Update Statud"  style="margin-top: 10px;">
                          </td>
                        </tr>
                    </table>
                  </form>
                </div>
            </div>
      </div>

        <div class="accordion" id="collapse-group">
          <div class="accordion-group widget-box">
            <div class="accordion-heading">
              <div class="widget-title"> 
                  <h5>Billing Address</h5>
              </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
                <div class="widget-content"> 
                  {{$userDetails->name}}<br>
                  {{$userDetails->address}}<br>
                  {{$userDetails->city}}<br>
                  {{$userDetails->state}}<br>
                  {{$userDetails->pincode}}<br>
                  {{$userDetails->country}}<br>
                  {{$userDetails->mobile}}<br>
                </div>
            </div>
          </div>

        </div>





      </div>
      </div>

    <hr>
    <div class="row-fluid">

             
     <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Order Code</th>
                        <th>Order Name</th>
                        <th>Order Size</th>
                        <th>Order Color</th>
                        <th>Order Price</th>
                        <th>Order Qty</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($oderDetails->orders as $pro)
                    <tr>
                        <td>{{$pro->product_code}}</td>
                        <td>{{$pro->product_name}}</td>
                        <td>{{$pro->product_size}}</td>
                        <td>{{$pro->product_color}}</td>
                        <td>{{$pro->product_price}}</td>
                        <td>{{$pro->product_qty}}</td>

                    </tr>
                    @endforeach
                </tbody>

       </table>
    </div>

  </div>
</div>
<!--main-container-part-->

@endsection