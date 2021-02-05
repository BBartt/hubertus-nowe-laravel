@extends('layouts.main')

@section('content')
  <section class="standard-section">

    <h1>Dodaj dane</h1>

    <x-errors />

    <form action="{{ route('sztandar.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="title">Tytuł:</label>
        <input type="text" name="title" autofocus />
      </div>
      <br />
      <div>
        <label for="image">Zdjęcie:</label>
        <input type="file" name="image" />
      </div>

      <br />
      <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('sztandar.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
