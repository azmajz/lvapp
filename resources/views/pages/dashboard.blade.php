@extends('layouts.app')
@section('content')
<div class="row my-5">
    <h1>Welcome to Dashboard Page </h1>

    <h2>Recent Posts</h2>
    @if (count($posts)>0)
    <ul>
        @foreach ($posts as $post)
        <li><a href="#">{{$post->title}}</a></li>
        @endforeach
    </ul>
    @else
    <p>No posts found.</p>
    @endif
</div>
@endsection