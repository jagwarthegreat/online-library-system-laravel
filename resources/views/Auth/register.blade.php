@extends('Shared.template')

@section('styles')
<style>
	 body{
               background-image: url("{{URL::to('images/1.jpg')}}");  
               background-attachment: fixed;
              background-size: auto 100%;
              background-position: center;

            }
    .well{
    	margin-top: 15%;
    	opacity: .8;
    	border-radius: 20px;

    } 
        
</style>
@endsection

@section('contents')
	<div class="col-md-6 col-md-offset-3 well">

		
		@include('Shared.notification');
		
		<form action="{{route('register_check')}}" method="POST">
			<div class="form-group {{$errors->has('name') ? 'has-error': ''}}">
				<label>Name</label>
				<input type="text" name="name" class="form-control" >
			</div>
			<div class="form-group {{$errors->has('email') ? 'has-error': ''}}">
				<label>Email</label>
				<input type="email" name="email" class="form-control" >
			</div>
			<div class="form-group">
				<label>Account Type</label>
				<select class="form-control" name="role_id">
					<option value="2">Librarian</option>
					<option value="3">Faculty</option>
					<option value="4">Student</option>
				</select>
			</div>
			<div class="form-group {{$errors->has('username') ? 'has-error': ''}}">
				<label>Username</label>
				<input type="text" name="username" class="form-control" >
			</div>
			<div class="form-group {{$errors->has('password') ? 'has-error': ''}}">
				<label>Password</label>
				<input type="password" name="password" class="form-control" >
			</div>
			<div class="form-group {{$errors->has('repeat_password') ? 'has-error': ''}}">
				<label>Repeat Password</label>
				<input type="password" name="repeat_password" class="form-control">
			</div>
			<div class="form-group">
				@csrf
				<input type="submit" value="SUBMIT" class="btn btn-primary btn-block"> 
			</div>
		</form>
	</div>
@endsection