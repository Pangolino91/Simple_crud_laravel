@extends('layouts.main')

@section('content')
    <form enctype="multipart/form-data" action="{{ URL::to("/immagineuploadata".'/'.$immagine->id)}}" method="post">
    @csrf
    {{method_field('PATCH')}}
    {{-- <p>{{ URL::to("/immagineuploadata".'/'.$immagine->id)}}</p> --}}
    <h3>{{'Titolo Immagine: ' . $immagine->nomeimmagine}}</h3>
    <label for="descrizione"></label>
    <textarea type="text" name="descrizione" value="{{$immagine->descrizione}}"></textarea><br>
    <label for=""></label>
    <input type="file" name="nomeimmagine" value="{{$immagine->nomeimmagine}}"><br>
    <input type="submit" name="submit" value="update">
    <br>
    <img src="{{asset('storage/immagini/'.$immagine->nomeimmagine)}}" alt="">
    </form>


    <form action="{{ URL::to("/immagineuploadata".'/'.$immagine->id)}}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit">Delete the Element!</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {{-- <p>{{$immagine}}</p> --}}
@endsection