@extends('layouts.main')

@section('content')
  <section class="dogs-section">

    <h1>Dodaj psa</h1>

    <x-errors />

    <form action="{{ route('psy.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="image">Zdjęcie:</label>
        <input type="file" name="image" />
      </div>
      <br />
      <div>
        <label for="description">Opis pod zdjęciem:</label>
        <input type="text" name="description" autofocus />
      </div>

      <br />
      <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('psy.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
