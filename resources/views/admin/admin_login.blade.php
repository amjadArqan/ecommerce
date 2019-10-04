<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>DeFacto Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/backend_css/matrix-login.css')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">
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
        <form id="loginform" class="form-vertical" method="POST" action="{{url('admin')}}">
            @csrf
				 <div class="control-group normal_text"> <h3><span style="color:#269064">De</span><span style="color:#F54059">F</span ><span style="color:#269064">act</span><span style="color:#FFD344">o</span> Admin</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="fa fa-user"> </i></span><input type="text" name="username" placeholder="User Name" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="fa fa-unlock-alt"></i></span><input type="password" name="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><strong>Do not have an account? <a href="{{url('/admin_register')}}" style="color: #28b779;">Sign up</a></strong></span>
                    <span class="pull-right"><input type="submit" value="Sign In" class="btn btn-success" /></span>
                </div>
            </form>

        </div>
        
        <script src="{{ asset('js/backend-js/jquery.min.js')}}"></script>  
        <script src="{{ asset('js/backend-js/matrix.login.js')}}"></script> 
        <script src="{{ asset('js/backend-js/bootstrap.min.js')}}"></script> 

    </body>

</html>
