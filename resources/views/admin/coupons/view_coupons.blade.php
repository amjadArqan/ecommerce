@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="
    3">Coupons</a><a href="#" class="current">View Coupons</a> </div>
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
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Products</h5>
           
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Coupon ID</th>
                  <th>Coupon Code</th>
                  <th>Amount</th>
                  <th>Amount Type</th>
                  <th>Expiry Date</th>
                  <th>Create Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($coupons as $coupon)
                <tr>
                  <td>{{ $coupon->id}}</td>
                  <td>{{ $coupon->coupon_code }}</td>
                  <td>{{ $coupon->amount }}
                  @if($coupon->amount_type == "precentage") % @else $ @endif
                  </td>
                  <td>{{ $coupon->amount_type }}

                  </td>
                  <td>{{ $coupon->expiry_date }}</td>
                  <td>{{$coupon->status }}
                  @if($coupon->status == "1") Active @else Inactive @endif

                   </td>
                  <td>{{$coupon->created_at }} </td>


                  <td>
                  <a href="{{url('/admin/edit-coupon/'.$coupon->id)}}" class="btn btn-primary btn-mini" title="Edit coupon">Edit</a>

                      <a  href="javascript:" rel="{{$coupon->id}}" rel1="delete-coupon" class="btn btn-danger btn-mini deleteRecord" title="Delete coupon">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection