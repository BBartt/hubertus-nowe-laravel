@extends('layouts.main')

@section('content')
  <div class="messages-section">

    <h1>Edytuj komunikat</h1>

    <x-errors />

    <form action="{{ route('komunikaty.update', $komunikaty->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')

      <div>
        <label for="title">Tytuł komunikatu:</label> <br>
        <input type="text" name="title" value="{{ $komunikaty->title }}" />
      </div>
      <div>
        <label for="description">Opis:</label> <br>
        <textarea name="description" rows="10" cols="100">{{ $komunikaty->description }}</textarea>
      </div>
      <div>
        <label for="image">Opcjonale zdjęcie:</label>
        <input type="file" name="image" />
        <input type="hidden" name="image" value="{{ $komunikaty->image }}" />
      </div>

      <hr />

      <div>
        <label for="link">Opcjonalny link u dołu komunikatu:</label>
        <input type="text" name="link" value="{{ $komunikaty->link }}" />
      </div>
      <div>
        <label for="linkName">Opcjonalna zawartość linku (nazwa w którą kliknie myśliwy):</label>
        <input type="text" name="linkName" value="{{ $komunikaty->linkName }}" />
      </div>

      <br />
      <br />

      <input type="submit" value="Zaktualiuj" />
      <a href="{{ route('komunikaty.index') }}" class="btn btn-link">Powrót</a>
    </form>


  </div>
@endsection
