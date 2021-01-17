@extends('layouts.main')

@section('content')
  <section class="news-section">

    <h1>Edycja aktualnosci</h1>

    <x-errors />

    <form action="{{ route('aktualnosci.update', $aktualnosci->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <div>
        <label for="image">Zdjęcie:</label>
        <input type="file" name="image" />
      </div>
      <br>
      <div>
        <label for="description">Opis:</label> <br>
        <textarea name="description" rows="10" cols="100" autofocus>{{ $aktualnosci->description }}</textarea>
      </div>
      <br />
      <br />

      <input type="submit" value="Edytuj" />
      <a href="{{ route('aktualnosci.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
