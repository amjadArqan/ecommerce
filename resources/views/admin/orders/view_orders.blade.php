@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="
    3">Orders</a><a href="#" class="current">View Orders</a> </div>
    <h1>Orders</h1>
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
            <h5>View Orders</h5>
           
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Order Date</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Ordered Products</th>
                  <th>Order Amount</th>
                  <th>Order Status</th>
                  <th>Order Method</th>
                  <th style="width: 191px;">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ $order->id}}</td>
                  <td>{{ $order->created_at }}</td>
                  <td>{{ $order->name }}</td>
                  <td>{{ $order->user_email }}</td>
                <td>
                   @foreach($order->orders as $pro)  
                      {{$pro->product_name}} || {{$pro->product_code}} <br>
                   @endforeach

                  </td>
                  <td>{{$order->grand_total }} </td>
                  <td>{{$order->status }} </td>
                  <td>{{$order->payment_method }}</td>

                  <td>
                     <a target="_blank" href="{{url('admin/view-orders/'.$order->id)}}"  class="btn btn-success btn-mini" title="View Orders">View Order Details</a><br><br>
                     <a target="_blank" href="{{url('admin/view-order-invoice/'.$order->id)}}"  class="btn btn-success btn-mini" title="View Orders">View Order Invoice</a>

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