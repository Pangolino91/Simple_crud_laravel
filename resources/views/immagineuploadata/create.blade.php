@extends('layouts.main')

@section('content')
    <form enctype="multipart/form-data" method="POST" action="{{ URL::to('/immagineuploadata')}}">
        @csrf
        <div class="form-group">
          <label class="label-form" for="descrizione">Descrizione Immagine</label>
          <textarea type="text" class="form-control text-area" name="descrizione" id="" aria-describedby="helpId" placeholder=""></textarea>
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="form-group">
          <label for="nomeimmagine">Nome Immagine Uploadata</label>
          <input type="file" class="form-control-file" name="nomeimmagine" id="" placeholder="" aria-describedby="fileHelpId">
          <small id="fileHelpId" class="form-text text-muted">Help text</small>
        </div>
        <input type="submit" value="submit">
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

@endsection

