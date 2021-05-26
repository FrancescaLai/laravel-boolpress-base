@extends('layouts.base')

@section('pageTitle')
    Crea un nuovo post
@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
<form action="{{route('admin.posts.store')}}" method="POST">
  @method('POST')
  @csrf

    <div class="form-group">
      <label for="title">Titolo</label>
      <input type="text" class="form-control" id="title" placeholder="Title" name="title">
    </div>
    <div class="form-group">
      <label for="title">Data</label>
      <input type="date" class="form-control" id="date" placeholder="Date" name="date">
    </div>
    <div class="form-group">
      <label for="content">Contenuto</label>
      <textarea class="form-control" id="content" placeholder="content" name="content" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
      <label for="image">Immagine</label>
      <input type="text" class="form-control" id="image" placeholder="image" name="image">
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" id="published" name="published">
      <label class="form-check-label" for="published">Pubblicato</label>
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-primary">Crea</button>
    </div>
    
  </form>
@endsection