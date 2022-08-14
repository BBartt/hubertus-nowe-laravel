@extends('layouts.main')

@section('content')
  <section class="member-section">

    <h1>Dodaj członka koła łowieckiego i/lub rezydenta</h1>

    <x-errors />

    <form action="{{ route('czlonkowie_kola.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="name">Imię i Nazwisko członka koła:</label>
        <input type="text" name="name" autofocus />
      </div>

      <br /> <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('czlonkowie_kola.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
