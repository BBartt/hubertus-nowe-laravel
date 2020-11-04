@extends('layouts.app')

@section('content')
  <h1>Dodaj członka zarządu</h1>

  <x-errors />

  <form action="{{ route('zarzad.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="name">Imię i Nazwisko:</label>
      <input type="text" name="name" />
    </div>
    <br />
    <div>
      <label for="image">Zdjęcie:</label>
      <input type="file" name="image" />
    </div>

    <br />
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('zarzad.index') }}" class="btn btn-link">Powrót</a>
  </form>

@endsection
