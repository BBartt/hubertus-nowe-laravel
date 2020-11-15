@extends('layouts.main')

@section('content')
  <section class="management-section">

    <h1>Edycja danych członka zarządu</h1>

    <x-errors />

    <form action="{{ route('zarzad.update', $zarzad->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <div>
        <label for="name">Imię i Nazwisko:</label>
        <input type="text" name="name" autofocus value="{{ $zarzad->name }}" />
      </div>
      <br />
      <div>
        <label for="image">Zdjęcie:</label>
        <input type="file" name="image" />
      </div>

      <br />
      <br />

      <input type="submit" value="Edytuj" />
      <a href="{{ route('zarzad.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
