@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
<a href="{{ route('noob.create') }}" class="btn btn-success float-right">Add Categories</a>
</div>
<div class="card card-default">

	<div class="card-header">
		Categories	
	</div>

	<div class="card-body">
		 @if($categories->count()==0)
        <table>
            <tbody>
                <tr>
                    <td style="color: red; text-align: center;">
                        No Categories has been Created!
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
			@foreach($categories as $category)
			<tr>
				<td>
					{{$category->name}}
				</td>
				<td>
					{{$category->posts()->count()}}
				</td>
				<td>
					<a href="{{ route('noob.edit',$category->id )}}" class="btn btn-info btn-sm">Edit</a>

					<a onclick="event.preventDefault();
	             	document.getElementById('delete_category{{$category->id}}').submit();" class="btn btn-danger btn-sm" style="color: #fff;">Delete</a>
	             <form id="delete_category{{$category->id}}" action="{{route('noob.destroy',$category->id)}}" method="POST">
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