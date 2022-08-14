@extends('layouts.main')

@section('content')
  <section class="standard-section">

    <h1>Edycja danych</h1>

    <x-errors />

    <form action="{{ route('sztandar.update', $sztandar->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <div>
        <label for="title">Tytuł:</label>
        <input type="text" name="title" autofocus value="{{ $sztandar->title }}" />
      </div>
      <br />
      <div>
        <label for="image">Zdjęcie:</label>
        <input type="file" name="image" />
      </div>

      <br />
      <br />

      <input type="submit" value="Edytuj" />
      <a href="{{ route('sztandar.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
