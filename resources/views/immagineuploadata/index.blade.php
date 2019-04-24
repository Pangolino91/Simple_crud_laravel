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

<div class="container">
    <div class="row">
@foreach ($immagine as $item)
<div class="col-lg-4 col-sm-6">
    <h2>Immagine {{$item->id}}</h2>
        <p>{{$item->nomeimmagine}}</p>
        <p>{{$item->descrizione}}</p>
        <img class="card-img" src="{{asset('storage/immagini/'.$item->nomeimmagine)}}" alt=""><br>
        <a href="{{URL::to('/immagineuploadata'.'/'.$item->id)}}">Clicca Per modificare</a>
    </div>
@endforeach
 
{{ $immagine->links() }}
    </div>
</div>
@endsection

{{-- <p>{{$test}}</p> --}}