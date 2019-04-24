@extends('layouts.main')



@section('content')

<div>
<a href="{{URL::to('/immagineuploadata/create')}}">Crea Nuovo Elemento</a>
</div>
<br>
<br>
<br>
<br>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    @if (session('status-delete'))
    <div class="alert alert-danger">
        {{ session('status-delete') }}
    </div>
    @endif


@foreach ($immagine as $item)
<h2>Immagine {{$item->id}}</h2>
    <p>{{$item->nomeimmagine}}</p>
    <p>{{$item->descrizione}}</p>
    <img width="300" src="{{asset('storage/immagini/'.$item->nomeimmagine)}}" alt=""><br>
    <a href="{{URL::to('/immagineuploadata'.'/'.$item->id)}}">Clicca Per modificare</a>
@endforeach
 
{{ $immagine->links() }}

@endsection

{{-- <p>{{$test}}</p> --}}