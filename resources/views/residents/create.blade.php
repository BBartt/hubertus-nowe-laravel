@extends('layouts.main')

@section('content')
  <section class="residents-section">

    <h1>Dodaj rezydenta:</h1>

    <x-errors />

    <form action="{{ route('rezydenci.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="name">Imię i Nazwisko rezydenta:</label>
        <input type="text" name="name" autofocus />
      </div>

      <br /> <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('czlonkowie_kola.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
