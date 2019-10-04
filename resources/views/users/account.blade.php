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
					<div class="login-form">
						<h2>Update Account</h2>
						<form id="accountform" name="accountform" action="{{url('account')}}" method="post">
                            @csrf
							<input value="{{$userDetails->name}}" id="name" name="name" type="text" placeholder="Name" />
                            <input value="{{$userDetails->address}}" id="address" name="address" type="text" placeholder="Address" />
							<input value="{{$userDetails->city}}" id="city" name="city" type="text" placeholder="City" />
                            <input value="{{$userDetails->state}}" id="state" name="state" type="text" placeholder="State" />
                            <select id="country" name="country" style="padding: 12px 10px;margin-bottom: 12px;">
								<option value="">Select Country</option>
								@foreach($countries as $country)
									<option value="{{$country->country_name}}" @if ($country->country_name == $userDetails->country) selected @endif >{{$country->country_name}}</option>
								@endforeach
							</select>
                            <input value="{{$userDetails->pincode}}" id="pincode" name="pincode" type="text" placeholder="Pincode" />
                            <input value="{{$userDetails->mobile}}" id="mobile" name="mobile" type="text" placeholder="Mobile" />

							<button type="submit" class="btn btn-default">update</button>
						</form>
					</div>
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form">
						<h2>Update Password</h2>
						<form action="{{url('update-user-pwd')}}" method="post" id="passwordFrom" name="passwordForm">
                            @cSrf
							<input type="password" name="current_pwd" id="current_pwd" placeholder="Current Password">
							<span id="chkPwd" style="display: block;margin-bottom: 10px;"></span>
							<input type="password" name="new_pwd" id="new_pwd" placeholder="New Password">
							<input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm Password">
							<button type="submit" class="btn btn-default">update</button>

						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	@endsection