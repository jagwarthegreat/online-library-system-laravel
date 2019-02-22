@extends('Librarian.template')

@section('styles')

@endsection

@section('contents')
	<h3 class="text-center">Book List</h3>
	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Create Book</button>
	@include('Shared.notification')
	<table class="table" id="table">
		<thead>
			<tr>
				<th>Image</th>
				<th>Title</th>
				<th>Author</th>
				<th>Publisher</th>
				<th>Location</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($books as $book)
				<tr>
					<td>
						<img src="{{URL::to('images')}}/{{$book->image}}" class="img-thumbnail" width="80px">
					</td>
					<td>{{$book->title}}</td>
					<td>{{$book->author}}</td>
					<td>{{$book->publisher}}</td>
					<td>{{$book->location}}</td>
					<td>
						@if($book->status_id == 0)
							Available
						@elseif($book->status_id == 1)
							Pending Reservation Request
						@elseif($book->status_id == 2)
							Reserve
						@endif
					</td>
					<td>
						<button class="btn btn-info btn-xs editBook" data-toggle="modal" data-target="#myModal2" id="editBook" value="{{$book->id}}">Edit</button>
						<a href="{{route('librarian_book_delete',$book->id)}}" class="btn btn-danger btn-xs">Delete</a>
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
        <h4 class="modal-title">Enter Book Informations</h4>
      </div>
      <div class="modal-body">
        <form action="{{route('librarian_books_check')}}" method="POST" enctype="multipart/form-data">
        	<div class="form-group">
        		<label>Title</label>
        		<input type="text" name="title" class="form-control" required="">
        	</div>

        	 <div class="form-group">
	       		<label>Author</label>
	        	<input type="text" name="author" class="form-control" required="">
	       </div>

	        <div class="form-group">
	       		<label>Image</label>
	        	<input type="file" name="image" class="form-control" required="">
	       </div>

	       	<div class="form-group">
	       		<label>Publisher</label>
	        	<input type="text" name="publisher" class="form-control" required="">
		    </div>

		    <div class="form-group">
	       		<label>Location</label>
	        	<input type="text" name="location" class="form-control" required="">
		    </div>

		    <div class="form-group">
	       		@csrf
	        	<input type="submit" value="Submit" class="btn btn-primary" >
	        	 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
        	
        </form>
      
      </div>
      
    </div>

  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Book Informations</h4>
      </div>
      <div class="modal-body">
        <form >
        	<input type="button" value="0" class="btn btn-info" id="updateId" style="display: none">
        	
        	<div class="form-group">
        		<label>Title</label>
        		<input type="text" name="title" class="form-control" required="" id="title">
        	</div>

        	 <div class="form-group">
	       		<label>Author</label>
	        	<input type="text" name="author" class="form-control" required="" id="author">
	       </div>

	       	<div class="form-group">
	       		<label>Publisher</label>
	        	<input type="text" name="publisher" class="form-control" required="" id="publisher">
		    </div>

		    <div class="form-group">
	       		<label>Location</label>
	        	<input type="text" name="location" class="form-control" required="" id="location">
		    </div>

		    <div class="form-group">
	       		@csrf
	        	<input type="button" value="Update" class="btn btn-info" id="updateButton">
	        	 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
        	
        </form>
      
      </div>
      
    </div>

  </div>
</div>

@endsection

@section('scripts')
	<script>
		$(document).ready(function(){
			var data = [];
			var url = '{{route('librarian_books_update')}}';
			var token = '{{csrf_token()}}';
			$(".editBook").click(function(){
				var id = $(this).val();
					$.ajax({
					method: 'POST',
					url: url,
					data: {_token:token, id:id},
					success: function(msg){
						this.data = msg;
						console.log(this.data);
						$("#title").val(msg.title);
						$("#author").val(msg.author);
						$("#publisher").val(msg.publisher);
						$("#location").val(msg.location);
						$("#updateId").val(msg.id);
						
					}

				});

			});

			$("#updateButton").click(function(){
				var url2 = '{{route('librarian_books_update_check')}}';
				var title = $("#title").val();
				var author = $("#author").val();
				var publisher = $("#publisher").val();
				var location = $("#location").val();
				var updateId = $("#updateId").val();

				$.ajax({
					method: 'POST',
					url: url2,
					data: {_token:token, id:updateId, title: title,author:author,publisher: publisher, location:location},
					success: function(msg){
						if(msg == 'success'){
							$('#myModal2').modal('toggle');
							window.location.reload();
							

						}
						
					}

				});

				
			});
			
		});
	</script>
@endsection