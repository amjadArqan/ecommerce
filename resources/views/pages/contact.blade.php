@extends('layouts.frontLayout.front_design')
@section('content')
	
	<section>
		<div class="container"> 
            @if(Session::has('flash_message_Success'))

              <div class="alert alert-success alert-block" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
                 {{ session('flash_message_Success')}}
             </div>
             @endif   
			<div class="row">
				<div class="col-sm-3">
					 @include('layouts.frontLayout.front_sidebar')
</div>
				 <div class="col-sm-9">
						<h2 class="title text-center">CONTACT US</h2>
                        <form action="{{url('/page/contact')}}" id="main-contact-form" class="contact-form " name="contact-form" method="post">
                        @csrf
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name" style="height: 40px;border-radius: 0px">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email" style="height: 40px;border-radius: 0px">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject" style="height: 40px;border-radius: 0px">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here" style="border-radius: 0px"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
					</div>
			</div>
		</div>
    </section>

@endsection

