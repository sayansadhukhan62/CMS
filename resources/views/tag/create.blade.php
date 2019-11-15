@extends('layouts.app')

@section('content')

<div class="card card-default">

	<div class="card-header">
		{{ isset($tag) ? 'Edit Tag' : 'Create Tag'}}	
	</div>
	<div class="card-body">
		@if($errors->any())

		<div class="alert alert-danger">
			<ul class="list-group">
				@foreach($errors->all() as $error)
				<li class="list-group-item text-danger">
					{{$error}}
				</li>
				@endforeach
			</ul>
			
		</div>

		@endif
		<form action="{{isset($tag) ? route('tag.update',$tag->id) : route('tag.store')}}" method="POST">
			@csrf
			@if(isset($tag))

				@method('PUT')

			@endif
			<div class="form-group">
			<label for="name">Name</label>
		<input class="form-control" id="name" type="text" name="name" value="{{isset($tag) ? $tag->name : ''}}">
			</div>

			<div class="form-group">
				<button class="btn btn-success">{{isset(($tag)) ? 'Update Tag' : 'Create Tag' }}</button>	
			</div>

		</form>
		
	</div>
	
</div>

@endsection