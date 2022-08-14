@extends('layouts.main')

@section('content')
  <section class="data-section">

    <h1>Dodaj dane na stronę główną</h1>

    <x-errors />

    <form action="{{ route('main.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="image">Zdjęcie:</label>
        <input type="file" name="image" />
      </div>
      <br />
      <div>
        <label for="description">Opis:</label>
        <input type="text" name="description" autofocus />
      </div>

      <br />
      <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('home') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
