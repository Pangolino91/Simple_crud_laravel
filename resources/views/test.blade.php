@extends('layouts.main')


@section('content')
    
    <h2>HELLO I AM TEST</h2>
    <ul>
        @foreach ($user as $user)
            <li>{{$user}}</li> 
        @endforeach
    </ul>    
    <img src="{{asset('storage/immagini/Desert.jpg.1556618328')}}" alt="">
{{-- <p>{{$user}}</p> --}}
@endsection