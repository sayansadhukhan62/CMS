@extends('layouts.app')

@section('content')


<div class="card-body">
		
	  <table class="table">
			<thead>
				<tr>
				<th>Image</th>
				<th>Title</th>
				<th><a href="{{route('emptyTrash')}}" class="btn btn-danger btn-sm">Empty Trash</a></th>
				</tr>
			</thead>
			<tbody>
				@foreach($posts as $post)
			<tr>
			<td>
				<img src="storage\{{$post->image}}" width="80px" height="60px">
			</td>
				<td>{{$post->title}}</td>
				<td><a href="{{route('restore',$post->id)}}" class="btn btn-info btn-sm">Restore</a>
					
	             <a href="{{route('delete',$post->id)}}" class="btn btn-danger btn-sm">Delete</a>
				</td>
			</tr>
			@endforeach
			</tbody>
	</table>
</div>

@endsection