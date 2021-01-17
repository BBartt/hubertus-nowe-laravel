@extends('layouts.main')

@section('content')
  <section class="dead-section">

    <h1>Edycja danych osoby</h1>

    <x-errors />

    <form action="{{ route('kraina.update', $kraina->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <div>
        <label for="name">Imię i Nazwisko:</label>
        <input type="text" name="name" autofocus value="{{ $kraina->name }}" />
      </div>

      <br />
      <br />

      <input type="submit" value="Edytuj" />
      <a href="{{ route('kraina.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
