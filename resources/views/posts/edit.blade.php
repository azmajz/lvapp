@extends('layouts.app')
@section('content')

<div class="row my-5">
    <div class="col-md-6 m-auto">
        <div class="{{ session('alert-class')}}">{{ session('alert-msg')}}</div>
        <h2 class="mb-3">Update Post</h2>
        <form action="/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" rows="5" name="body">{{$post->body}}</textarea>
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" name="cover_image" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose Image</label>
                  </div>            
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection