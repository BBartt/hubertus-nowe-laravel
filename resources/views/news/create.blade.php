@extends('layouts.main')

@section('content')
  <section class="news-section create">

    <h1>Dodaj aktualność</h1>

    <x-errors />

    <form action="{{ route('aktualnosci.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="image">Zdjęcie:</label>
        <input type="file" name="image" />
      </div>
      <br>
      <div>
        <label for="description">Opis:</label> <br>
        <textarea name="description" rows="10" cols="100" autofocus></textarea>
      </div>


      <br />
      <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('aktualnosci.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
