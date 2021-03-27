@extends('layouts.app')
@section('content')

<div class="row my-5">
    <div class="col-md-6 m-auto">
        <h2 class="mb-3">Create Post</h2>

        {{-- @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
         @enderror --}}

         @if ($errors->any())
                 @foreach ($errors->all() as $error)
                 <div class="alert alert-danger">{{ $error }}</div>
                 @endforeach
        @endif


        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value={{old('title')}}>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" rows="5" name="body">{{old('body')}}</textarea>
            </div>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" name="cover_image" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose Image</label>
                </div>            
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>


@endsection