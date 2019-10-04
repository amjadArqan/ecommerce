@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupon</a> </div>
      <h1>Coupons</h1>
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
    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Product </h5>
            </div>
            <div class="widget-content nopadding">
            <form  class="form-horizontal" method="post" action="" name="add_coupon" id="add_coupon" >
                @csrf



                <div class="control-group">
                  <label class="control-label">Coupon code</label>
                  <div class="controls">
                    <input type="text" name="coupon_code" id="coupon_code" minlenght="5" maxlenght="15" required>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Amount</label>
                  <div class="controls">
                    <input type="number" name="amount" id="amount" required min="0">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Amount Type</label>
                  <div class="controls">
                    <select name="amount_type" id="amount_type" style="width:220px">
                    <option value="precentage">Precentage</option>
                    <option value="fixed">Fixed</option>
                    </select>
                  </div>

                <div class="control-group">
                    <label class="control-label">Expiry date</label>
                    <div class="controls">
                      <input type="text" name="expiry_date" id="expiry_date" autocomplete="off" required>
                    </div>
                  </div>                <div class="control-group">
                    <label class="control-label">Enable</label>
                    <div class="controls">
                      <input type="checkbox" name="status" id="status" value="1">
                    </div>
                  </div>
                </div>


                <div class="form-actions">
                  <input type="submit" value="Add Coupon" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection