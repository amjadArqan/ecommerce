@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="
    3">Banners</a><a href="#" class="current">View Products</a> </div>
    <h1>Banners</h1>
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
            <h5>View Banners</h5>
           
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>banner ID</th>
                  <th>banner image</th>
                  <th>banner Title</th>
                  <th>baner link</th>

                  <th>banner Description</th>
                  <th>Status</th>

                  <th style="width:150px">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($banners as $banner)
                <tr>
                  <td>{{ $banner->id}}</td>
                  <td>
                    <img src="{{asset('images/backend_images/banners/'.$banner->image)}}" width="50px"  style="display: block;margin: auto;" >
                  </td>
                  <td>{{ $banner->title }}</td>
                  <td>{{ $banner->link }}</td>
                  <td>{{ $banner->description }}</td>
                  <td>{{ $banner->status }}</td>


                  <td>
                      <a href="{{url('/admin/edit-banner/'.$banner->id)}}" class="btn btn-primary btn-mini" title="Edit banner">Edit</a>

                      <a <?php /*href="{{url('/admin/delete-product/'.$product->id)}}"*/ ?> href="javascript:" rel="{{$banner->id}}" rel1="delete-banner" class="btn btn-danger btn-mini deleteRecord" title="Delete banner">Delete</a>
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