@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="
    3">Products</a><a href="#" class="current">View Products</a> </div>
    <h1>Products</h1>
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
                  <th>Product ID</th>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Product color</th>
                  <th>Product description</th>
                  <th>Product Price</th>
                  <th>Feature Item</th>

                  <th>Product image</th>

                  <th style="width: 191px;">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($products as $product)
                <tr>
                  <td>{{ $product->id}}</td>
                  <td>{{ $product->category_id }}</td>
                  <td>{{ $product->category_name }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->product_code }}</td>
                  <td>{{$product->product_color }} </td>
                  <td>{{$product->description }} </td>
                  <td>{{$product->price }}</td>
                  <td>
                  @if ( $product->feature_item  == 1) Yes @else No @endif</td>

                  <td>
                    <img src="{{asset('images/backend_images/products/small/'.$product->image)}}" width="50px"  style="display: block;margin: auto;" >
                  </td>

                  <td>
                     <a href="#myModal{{$product->id}}" data-toggle="modal" class="btn btn-success btn-mini" title="View Product">View</a>
                      <a href="{{url('/admin/edit-product/'.$product->id)}}" class="btn btn-primary btn-mini" title="Edit Product">Edit</a>
                      <a href="{{url('/admin/add-attributes/'.$product->id)}}"  class="btn btn-success btn-mini" title="Add attributes">Add</a>
                      <a href="{{url('/admin/add-images/'.$product->id)}}"  class="btn btn-info btn-mini" title="Add images">Add</a>

                      <a <?php /*href="{{url('/admin/delete-product/'.$product->id)}}"*/ ?> href="javascript:" rel="{{$product->id}}" rel1="delete-product" class="btn btn-danger btn-mini deleteRecord" title="Delete product">Delete</a>
                  </td>
                </tr>
                <div id="myModal{{$product->id}}" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>{{ $product->product_name }} Full Details</h3>
              </div>
              <div class="modal-body">
                <p>Product ID : {{ $product->id}}</p>
                <p>Category ID : {{ $product->id}}</p>
                <p>Product Code : {{ $product->product_code }}</p>
                <p>Product Color : {{$product->product_color }}</p>
                <p>Price : {{$product->price }}</p>
                <p>Product Description : {{$product->description }}</p>


              </div>
            </div>
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