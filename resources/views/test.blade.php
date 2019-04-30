@extends('layouts.main')


@section('content')
    
    <h2>HELLO I AM TEST</h2>
    <ul>
        @foreach ($user as $user)
            <li>{{$user}}</li> 
        @endforeach
    </ul>    
{{-- <p>{{$user}}</p> --}}
@endsection