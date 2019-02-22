@extends('Shared.template')

@section('styles')
<style>
	 body{
               background-image: url("{{URL::to('images/2.jpg')}}");  
               background-attachment: fixed;
              background-size: auto 100%;
              background-position: center;

            }
    .well{
    	margin-top: 20%;
    	opacity: .9;
    	border-radius: 20px;

    } 
    #logo{
    	margin-top: -60px;
    }       
</style>
@endsection

@section('contents')
	<div class="col-md-6 col-md-offset-3 well">

		<p class="text-center">
			<img src="{{URL::to('images/logo.png')}}" width="120px" id="logo">
		</p>
		@include('Shared.notification')
		<form  action="{{route('login_check')}}" method="POST">
		  <div class="form-group">
		  	<label>Username:</label>
		  	<input type="text" name="username" class="form-control" placeholder="Enter Username" required>
		  </div>
		  <div class="form-group">
		  	<label>Password:</label>
		  	<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
		  </div>
		  <div class="form-group">
		  	@csrf
		  	 <button type="submit" class="btn btn-primary btn-block">Submit</button>
		      <p class="text-center">
		      	<a href="{{route('register')}}" style="color: gray">Register?</a>
		      </p>
		  </div>
		</form>
	</div>
@endsection