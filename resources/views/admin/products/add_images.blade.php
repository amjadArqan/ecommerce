@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="#">Products</a> <a href="#">Add Product Attribute</a> </div>
      <h1>Products Alternate Images</h1>
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
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Add Product Images </h5>

            </div>
            <div class="widget-content nopadding">
            <form enctype = "multipart/form-data" class="form-horizontal" method="post"  action="{{url('/admin/add-images/'.$productDetails->id)}}" name="add_image" id="add_image">
                @csrf
                <div class="control-group">
                  <label class="control-label"></label>
                  <input type="hidden" name='product_id' value="{{$productDetails->id}}">
                </div>
                <div class="control-group">
                  <label class="control-label">Product Name</label>
                  <label class="control-label"><strong>{{$productDetails->product_name}}</strong></label>
                </div>

                <div class="control-group">
                  <label class="control-label">Product Code</label>
                  <label class="control-label"><strong>{{$productDetails->product_code}}</strong></label>
                </div>

                <div class="control-group">
                  <label class="control-label">Product Color</label>
                  <label class="control-label"><strong>{{$productDetails->product_color}}</strong></label>

                </div>
                <div class="control-group">
                    <label class="control-label">Alternate Image(s)</label>
                    <div class="controls">
                      <input type="file" name="image[]" id="image" multiple="multiple">
                    </div>
                  </div>
                </div>

                      
               </div>
               </div>



                <div class="form-actions">
                  <input type="submit" value="Add images" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
  
    <div class="container-fluid">
   
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View images</h5>
           
           </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Image ID</th>
                  <th>Product ID</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php  echo $productImages ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>




    </div>
  </div>
  </div>

@endsection
