@extends('layouts.app')
@section('content')

<div class="row my-5">
    <div class="col-md-12 m-auto">
        <div class="{{ session('alert-class')}}"> {{ session('alert-msg')}}</div>

        <h3>All Blog Posts</h3>
        <hr>
        @if (count($posts)>0)
        @foreach ($posts as $post)
        <div class="card mb-2">
            <div class="card-body p-3">
                <h5>
                    <img src="/images/{{$post->cover_image}}" style="width:60px" class="border mr-2">
                    <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                    <small class="text-muted float-right">
                        Posted on - {{date('d/M/Y', strtotime($post->created_at))}}
                         by <span class="text-primary">{{$post->user->name}}</span>
                    </small>
                </h5>

            </div>
        </div>
        @endforeach
        @else
        <p>No posts found.</p>
        @endif

    </div>
</div>

@endsection