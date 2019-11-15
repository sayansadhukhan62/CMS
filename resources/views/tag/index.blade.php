@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
<a href="{{ route('tag.create') }}" class="btn btn-success float-right">Add Tags</a>
</div>
<div class="card card-default">

	<div class="card-header">
		Tags	
	</div>

	<div class="card-body">
		 @if($tags->count()==0)
        <table>
            <tbody>
                <tr>
                    <td style="color: red; text-align: center;">
                        No Tags has been Created!
                    </td>
                </tr>
            </tbody>
        </table>
        @else
		<table class="table">
			<thead>
			 <th>Name</th>
			 <th>Post Count</th>
			 <th></th>
			</thead>
			<tbody>
			@foreach($tags as $tag)
			<tr>
				<td>
					{{$tag->name}}
				</td>
				<td>
					{{$tag->posts()->count()}}
				</td>
				<td>
					<a href="{{ route('tag.edit',$tag->id )}}" class="btn btn-info btn-sm">Edit</a>

					<a onclick="event.preventDefault();
	             	document.getElementById('delete_tag{{$tag->id}}').submit();" class="btn btn-danger btn-sm" style="color: #fff;">Delete</a>
	             <form id="delete_tag{{$tag->id}}" action="{{route('tag.destroy',$tag->id)}}" method="POST">
	                @csrf
	                {{ method_field('delete')}}
	             </form>
				</td>
			</tr>
			@endforeach
			</tbody>	
		</table>
		@endif
	</div>	
</div>
@endsection