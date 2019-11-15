@extends('layouts.app')

@section('content')

<div class="card card-default">
<div class="card-header">
	{{ isset($post) ? 'Edit Post' : 'Create Post'}}	
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

<form action="{{isset($post)?route('post.update',$post->id) : route('post.store')}}" method="POST" enctype="multipart/form-data">
@csrf
@if(isset($post))

	@method('PUT')

@endif

<div class="form-group">
<label for="title">Title</label>	
<input type="text" class="form-control" id="title" name="title" value="{{isset($post) ? $post->title : ''}}">	
</div>
<div class="form-group">
<label for="description">Description</label>	
<textarea type="text" cols="3" rows="3" class="form-control" id="description" name="description" id="description">{{isset($post) ? $post->description : ''}}</textarea>	
</div>
<div class="form-group">
<label for="content">Content</label>	
<textarea type="text" cols="3" rows="3" class="form-control" id="content" name="content" id="content">{{isset($post) ? $post->content : ''}}</textarea>
</div>

<div class="form-group">
<label for="published_at">Published At</label>	
<input type="date" class="form-control" id="published_at" name="published_at" value="{{isset($post) ? $post->published_at : ''}}">	
</div>

@if(isset($post))
<div class="form-group">

<img src="{{asset('storage/'.$post->image)}}" style="width: 100%">
	
</div>
@endif
<div class="form-group">
<label for="image">Image</label>	
<input type="file" class="form-control" id="image" name="image">	
</div>

<div class="form-group">
<label for="Category">Category</label>
<select class="form-control" name="category" id="category">
	@if(!isset($post))
	<option selected></option>
	@endif
@foreach($categories as $category)
<option value="{{$category->id}}"
@if(isset($post))

@if($category->id==$post->id)
selected
@endif

@endif
>
{{$category->name}}	
</option>
@endforeach
</select>
</div>

@if($tags->count()>0)
<div class="form-group">
<label for="Tags">Tags</label>

<select class="form-control" name="tag[]" id="tag" multiple>
	@foreach($tags as $tag)
	<option value="{{$tag->id}}"
	@if(isset($post))
	@if(in_array($tag->id,$post->tags->pluck('id')->toArray()))
	selected
	@endif
	@endif
	>{{$tag->name}}</option>
	@endforeach
</select>
</div>
@endif

<div class="form-group">
	<button type="submit" class="btn btn-success">{{isset(($post)) ? 'Update Post' : 'Create Post' }}</button>	
</div>
</form>
</div>
</div>
@endsection