@extends('layouts.app')
@section('content')

<div class="row my-5">
    <div class="col-md-9 m-auto">
        <div class="card">

            <div class="card-body">
                <h2 class="card-title text-primary">{{$post->title}}</h2>
                <div class="text-center">
                    <img src="/images/{{$post->cover_image}}" class="img-fluid">
                </div>
                <p class="card-text">{{$post->body}}</p>
                <hr>
                <small class="text-muted float-right">
                    Posted on - {{date('d/M/Y', strtotime($post->created_at))}}
                     by <span class="text-primary">{{$post->user->name}}</span>
                </small>
            </div>
            <div class="card-footer text-muted">
                
                @auth                    
                @if ($post->postedBy(auth()->user()))
                    <form action="/posts/{{$post->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class="btn btn-outline-danger float-right ml-2">Delete Post</button>
                    </form>
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-info float-right">Edit Post</a>
                @endif
                @endauth
                
                <a href="/posts" class="btn btn-outline-secondary">Go Back</a>
            </div>
        </div>

    </div>
</div>

@endsection