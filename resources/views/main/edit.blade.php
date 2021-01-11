@extends('layouts.main')

@section('content')
  <section class="main-section">

    <h1>Edycja danych</h1>

    <x-errors />

    <form action="{{ route('main.update', $main->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <div>
        <label for="image">Zdjęcie:</label>
        <input type="file" name="image" />
      </div>
      <br />
      <div>
        <label for="description">Opis pod zdjęciem:</label>
        <input type="text" name="description" autofocus value="{{ $main->description }}" />
      </div>

      <br />
      <br />

      <input type="submit" value="Edytuj" />
      <a href="{{ route('home') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
