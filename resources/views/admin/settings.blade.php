@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
        <div id="content-header">
          <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">setting</a></div>
          <h1>Admin Setting</h1>
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
                    <h5>Update Password</h5>
                  </div>
                  <div class="widget-content nopadding">
                  <form class="form-horizontal" method="post" action="{{url('admin/update-pwd')}}" name="password_validate" id="password_validate" novalidate="novalidate">
                    @csrf
                    <div class="control-group">
                            <label class="control-label">Username</label>
                            <div class="controls">
                                <input type="text" name="username" id="username" value="{{$adminDetails->username}}" readonly />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Current Password</label>
                            <div class="controls">
                                <input type="password" name="current_pwd" id="current_pwd" />
                                <span id="chkPwd"></span>
                            </div>
                        </div>
                        
                      <div class="control-group">
                        <label class="control-label">New  Password</label>
                        <div class="controls">
                          <input type="password" name="new_pwd" id="new_pwd" />
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Confirm New password</label>
                        <div class="controls">
                          <input type="password" name="confirm_pwd" id="confirm_pwd" />
                        </div>
                      </div>
                      <div class="form-actions">
                        <input type="submit" value="Update Password" class="btn btn-success">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endsection
