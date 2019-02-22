@if(Session::has('err'))
	<div class="alert alert-danger text-center">
		{{Session::get('err')}}
	</div>
@endif

@if(Session::has('suc'))
	<div class="alert alert-success text-center">
		{{Session::get('suc')}}
	</div>
@endif