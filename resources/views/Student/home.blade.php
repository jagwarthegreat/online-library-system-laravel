@extends('Student.template')

@section('styles')
<script src="{{URL::to('tables/jquery-1.12.3.js')}}"></script>
  <script src="{{URL::to('tables/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::to('tables/dataTables.bootstrap.min.js')}}"></script>   
  <link rel="stylesheet" href="{{URL::to('tables/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{URL::to('tables/dataTables.bootstrap.min.css')}}">
@endsection

@section('contents')
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
						@if($book->status_id == 0)
							<a href="{{route('student_reserve_book',$book->id)}}" class="btn btn-success btn-xs">Reserve Now</a>
						@elseif($book->status_id == 1)
							Someone Request for reservation
						@endif

						
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#table').DataTable();
    
  } );
 </script>
@endsection