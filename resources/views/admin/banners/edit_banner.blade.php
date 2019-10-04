@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Edit Banner</a> </div>
      <h1>Edit Banner</h1>
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
            <form enctype = "multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/edit-banner/'.$bannerDetaile->id)}}" name="add_banner" id="add_banner">
                @csrf

                <div class="control-group">
                    <label class="control-label">Image</label>
                    <div class="controls">
                      <input type="file" name="image" id="image">
                      <input type="hidden" name="current_image" value="{{$bannerDetaile->image}}">
                         @if(!empty($productdetails->image))
                            <img src=" {{asset('/images/backend_images/banners/'.$bannerDetaile->image) }}"  style="width:40px">                       @endif
                    </div>
                  </div>

                <div class="control-group">
                  <label class="control-label">Title</label>
                  <div class="controls">
                    <input type="text" name="title" id="title" value="{{$bannerDetaile->title}}">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label"> Description</label>
                  <div class="controls">
                    <textarea type="text" name="description" id="description"  v > {{$bannerDetaile->description}}</textarea>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Link</label>
                  <div class="controls">
                    <input type="text" name="link" id="link" value="{{$bannerDetaile->link}}">
                  </div>
                </div>


                <div class="control-group">
                    <label class="control-label">Enable</label>
                    <div class="controls">
                      <input type="checkbox" name="status" id="status" value="1" @if($bannerDetaile->status == "1") checked @endif >
                    </div>
                  </div>
                </div>


                <div class="form-actions">
                  <input type="submit" value="Edit banner" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection