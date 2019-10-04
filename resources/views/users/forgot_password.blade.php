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
						<h2>Forget Password</h2>
						<form id="forgetpasswordForm" name="forgetpasswordForm" action="{{url('forgot-password')}}" method="post">
                            @csrf
                            <input name="email" type="email" placeholder="Email Address" required />
							<button type="submit" class="btn btn-default">Submit</button><br>

						</form>
					</div><!--/login form-->
				</div>

			</div>
		</div>
	</section><!--/form-->
	
	@endsection