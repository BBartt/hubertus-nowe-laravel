@extends('layouts.main')

@section('content')
  <section class="member-section">

    <h1>Edycja danych członka koła</h1>

    <x-errors />

    <form action="{{ route('czlonkowie_kola.update', $czlonkowie_kola->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <div>
        <label for="name">Imię i Nazwisko:</label>
        <input type="text" name="name" autofocus value="{{ $czlonkowie_kola->name }}" />
      </div>

      <br />
      <br />

      <input type="submit" value="Edytuj" />
      <a href="{{ route('czlonkowie_kola.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
