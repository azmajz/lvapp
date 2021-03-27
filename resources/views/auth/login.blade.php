@extends('layouts.app')
@section('content')

<div class="row my-5">
    <div class="col-md-6 m-auto">
        <h2 class="mb-3">Login Page</h2>

        @if (session('login_error'))
            <div class="alert alert-danger">{{ session('login_error')}}</div>
        @endif

        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        @endif

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

    </div>
</div>

@endsection