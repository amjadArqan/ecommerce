@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="
    3">Categories</a><a href="#" class="current">View Categories</a> </div>
    <h1>Categories</h1>
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
            <h5>View Categories</h5>
           
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Category Level</th>

                  <th>Category URL</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($categories as $category)
                <tr>
                  <td>{{ $category->id}}</td>
                  <td>{{$category->name}} </td>
                  <td>{{$category->parent_id}} </td>

                  <td>{{$category->url}}</td>
                  <td>
                      <a href="{{url('/admin/edit-category/'.$category->id)}}" class="btn btn-primary btn-mini">Edit</a>
                      <a <?php /*href="{{url('/admin/delete-category/'.$category->id)}}"*/  ?> href="javascript:" rel="{{$category->id}}" rel1="delete-category" id="delCat" class="btn btn-danger btn-mini deleteRecord">Delete</a>
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