@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a class="btn btn-success float-right" href="{{ route('post.create') }}">
        Add Post
    </a>
</div>
<div class="card card-default">
    <div class="card-header">
        Posts
    </div>
    <div class="card-body">
        @if($posts->count()==0)
        <table>
            <tbody>
                <tr>
                    <td style="color: red; text-align: center;">
                        No Post has been Created!
                    </td>
                </tr>
            </tbody>
        </table>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Image
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            @foreach($posts as $post)
            <tr>
                <td>
                    <img height="50px" src="{{asset('storage/'.$post->image)}}" width="70px">
                    </img>
                </td>
                <td>
                    {{$post->title}}
                </td>
                <td>
                    {{$post->category->name}}
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('post.edit',$post->id )}}">
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" onclick="event.preventDefault();
                    document.getElementById('delete_post{{$post->id}}').submit();" style="color: #FFF">
                        Trash
                    </a>
                    <form action="{{route('post.destroy',$post->id)}}" id="delete_post{{$post->id}}" method="POST">
                        @csrf
                    {{ method_field('delete')}}
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        @endif
    </div>
</div>
@endsection
