@extends('layouts.main')

@section('content')
  <section class="residents-section">

    <h1>Edycja danych rezydenta:</h1>

    <x-errors />

    <form action="{{ route('rezydenci.update', $rezydenci->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <div>
        <label for="name">Imię i Nazwisko:</label>
        <input type="text" name="name" autofocus value="{{ $rezydenci->name }}" />
      </div>

      <br />
      <br />

      <input type="submit" value="Edytuj" />
      <a href="{{ route('czlonkowie_kola.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
