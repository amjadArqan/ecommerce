@extends('layouts.frontLayout.front_design')
@section('content')

	<section id="form" style="margin-top: 80px;"><!--form-->
		<div class="container">
			<div class="row">
            @if(Session::has('flash_message_error'))

<div class="alert alert-danger alert-block" role="alert">
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
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form id="loginForm" name="loginForm" action="{{url('user-login')}}" method="post">
                            @csrf
                            <input name="email" type="email" placeholder="Email Address" />
                            <input name="password" type="password" placeholder="password" />
							<button type="submit" class="btn btn-default">Login</button><br>
							<a href="{{url('forgot-password')}}">Forgot Password?</a>

						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
                        <form action="{{url('/user-register')}}" method="post" id="registerForm">
                            @csrf
							<input id="name" name="name" type="text" placeholder="Name"/>
							<input id="email" name="email" type="email" placeholder="Email Address"/>
							<input id="myPassword" name="password" type="password" placeholder="Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	@endsection