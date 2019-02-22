@extends('Librarian.template')

@section('styles')

@endsection

@section('contents')
	@include('Shared.notification')
	
	<div class="col-md-6 col-md-offset-3">
		<form action="{{route('librarian_change_password_check')}}" method="POST">
			<div class="form-group">
				<label>New Password</label>
				<input type="password" name="password" class="form-control" required="">
			</div>
			<div class="form-group">
				<label>Repeat Password</label>
				<input type="password" name="repeat_password" class="form-control" required="">
			</div>
			<div class="form-group">
				@csrf
				<input type="submit" value="SUBMIT" class="btn btn-primary">
			</div>
		</form>
	</div>	
@endsection

@section('scripts')

@endsection