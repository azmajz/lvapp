@extends('layouts.app')
@section('content')

<div class="row my-5">
    <div class="col-md-12 m-auto">
        <div class="{{ session('alert-class')}}"> {{ session('alert-msg')}}</div>

        <h3>Your Blog Posts</h3>
        <hr>
        @if (count($posts)>0)
        <table class="table table-bordered">
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>View/Update</th>
                <th>Delete</th>
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td class="text-center">
                     <img src="/images/{{$post->cover_image}}" style="width:50px">
                    </td>
                    <td>{{$post->title}}</td>
                    <td>
                        <a href="/posts/{{$post->id}}" class="btn btn-outline-info">View Post</a>
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-info">Edit Post</a>
                    </td>
                    <td>
                        <form class="delete" action="/posts/{{$post->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type='submit' class="btn btn-outline-danger">Delete Post</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        @else
        <p>No posts found.</p>
        @endif

    </div>
</div>

@endsection