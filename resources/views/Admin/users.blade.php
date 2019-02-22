@extends('Admin.template')

@section('styles')
<script src="{{URL::to('tables/jquery-1.12.3.js')}}"></script>
  <script src="{{URL::to('tables/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::to('tables/dataTables.bootstrap.min.js')}}"></script>   
  <link rel="stylesheet" href="{{URL::to('tables/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{URL::to('tables/dataTables.bootstrap.min.css')}}">
  <style type="text/css">
  	.modal-dialog {
  text-align: center;
}

.modal-dialog:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px; /* Adjusts for spacing */
}

.modal-dialog {
  display: inline-block !important;
  text-align: left;
  vertical-align: middle !important;
}
  </style>
@endsection

@section('contents')
	@include('Shared.notification')
	<table class="table" id="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Account Type</th>
				<th>Account Status</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{$user->name}}</td>
					<td>{{$user->username}}</td>
					<td>{{$user->email}}</td>
					<td>
						@if($user->role_id == 2)
							Librarian
						@elseif($user->role_id == 3)
							Faculty
						@elseif($user->role_id == 4)
							Student
						@endif
					</td>
					<td>
						@if($user->status_id == 1)
							Active
						@else
							Banned
						@endif
					</td>
					<td>
						@if($user->status_id == 1)
							
							<button type="button" class="btn btn-danger btn-xs ban-me" data-toggle="modal" data-target="#myModal" value="{{$user->id}}">Banned</button>
						@else
							<a href="{{route('admin_unbanned_users',$user->id)}}" class="btn btn-info btn-xs">Unbanned</a>
						@endif

						
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you are you want to Banned?</h4>
      </div>
       <form>
      <div class="modal-body">	
      		<input type="hidden" id="user_id">
        	<div class="form-group">
        		<label>Enter Remarks</label>
        		<input type="text" name="remarks" class="form-control" id="remarks">
        	</div>
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" id="submitBtn">SUBMIT</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>	

@endsection

@section('scripts')
	<script>
		var token = '{{Session::token()}}';
        var url = '{{ route('admin_banned_users') }}';

		$(document).ready(function(){
			$(".ban-me").click(function(){
				var id = $(this).val();
				$("#user_id").val(id);

				
				
			});

			$("#submitBtn").click(function(){
				var remark = $("#remarks").val();
				var user_id = $("#user_id").val();
				if(remark == null || remark == ""){
					alert("Remark must not be empty");
					return false;
				}
				$.ajax({
		              method: 'POST',
		              url: url,
		              data: { user_id: user_id,remark : remark, _token : token},
		              success: function( msg ){
		                console.log(msg);
		                if(msg == 1){
		                	$('#myModal').modal('toggle');
		                	
		                	window.location.reload();
		                	alert("User banned successfully!");
		                }else{
		                	alert("Something wront try again");
		                }
		                
		              }
		          });
			})


		});
	</script>
	<script>
  $(document).ready(function() {
    $('#table').DataTable();
    
  } );
 </script>
@endsection