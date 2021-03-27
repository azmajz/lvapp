@extends('layouts.app')
    @section('content')
    {{-- <h1>Services Page</h1> --}}
    @if(count($services)>0)
    <h2 class="mt-5">{{$title}}</h2>
    <ul>
        @foreach ($services as $service)
        <li>{{$service}}</li>
        @endforeach
    </ul>
    @else
    <h3>No post found.</h3>
    @endif
@endsection