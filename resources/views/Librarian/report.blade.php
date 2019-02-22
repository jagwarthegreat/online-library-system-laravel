@extends('Librarian.template')

@section('styles')

@endsection

@section('contents')
	<h3 class="text-center">Reports</h3>
	
	<form action="{{route('librarian_reports')}}" method="GET">
		<input type="date" name="start" required="">
			to
		<input type="date" name="end">
			
		<input type="submit" value="submit" required="">
		@csrf
	</form>
	<table class="table" id="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Title</th>
				<th>Author</th>
				<th>Date</th>
				<th>Status</th>
				
			</tr>
		</thead>
		<tbody>
			@foreach($reports as $report)
				<tr>
					<td>{{$report->user->name}}</td>
					<td>{{$report->book->title}}</td>
					<td>{{$report->book->author}}</td>	
					<td>{{$report->created_at->toDayDateTimeString()}}</td>
					<td>
						@if($report->status_id == 2)
							Reserved
						@else
							
							Returned
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>





@endsection

@section('scripts')
	
@endsection