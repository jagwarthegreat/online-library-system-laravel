@extends('Librarian.template')

@section('styles')

@endsection

@section('contents')
	@include('Shared.notification')
	<table class="table" id="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Title</th>
				<th>Author</th>
				<th>Publisher</th>
				<th>Location</th>
				<th>Status</th>
				<th>Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($reserves as $res)
				<tr>
					<td>{{$res->user->name}}</td>
					<td>{{$res->book->title}}</td>
					<td>{{$res->book->author}}</td>
					<td>{{$res->book->publisher}}</td>
					<td>{{$res->book->location}}</td>
					<td>
						@if($res->status_id == 1)
							<p style="color: blue">Pending</p>
						@elseif($res->status_id == 2)
							<p style="color: green">reserved</p>
						@endif
					</td>
					<td>{{$res->created_at->diffForHumans()}}</td>
					<td>
						@if($res->status_id == 2)
							Reserved Book Already
						@else 
							<a href="{{route('librarian_reservation_accept',$res->id)}}" class="btn btn-success btn-xs">Accept</a>
						{{-- <a href="{{route('librarian_reservation_decline',$res->id)}}" class="btn btn-danger btn-xs">Decline</a> --}}

						<button type="button" class="btn btn-danger btn-xs ban-me" data-toggle="modal" data-target="#myModal" value="{{$res->id}}">Decline</button>
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
      		<input type="hidden" id="res_id">
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
        var url = '{{ route('librarian_reservation_decline') }}';

		$(document).ready(function(){
			$(".ban-me").click(function(){
				var id = $(this).val();
				$("#res_id").val(id);

				
				
			});

			$("#submitBtn").click(function(){
				var remark = $("#remarks").val();
				var res_id = $("#res_id").val();
				if(remark == null || remark == ""){
					alert("Remark must not be empty");
					return false;
				}
				$("#myModal").toggle();
				$.ajax({
		              method: 'POST',
		              url: url,
		              data: { res_id: res_id,remark : remark, _token : token},
		              success: function( msg ){
		                console.log(msg);
		                if(msg == 1){
		                	window.location.reload();
		                	alert("Book has been successfully Decline with notificaiotn by student");
		                }else{
		                	alert("Something wrong kindly try again");
		                }
		                
		                
		              }
		          });
			})


		});
	</script>
@endsection