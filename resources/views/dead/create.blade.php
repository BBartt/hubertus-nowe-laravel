@extends('layouts.main')

@section('content')
  <section class="dead-section">

    <h1>Dodaj osobę</h1>

    <x-errors />

    <form action="{{ route('kraina.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="name">Imię i Nazwisko:</label>
        <input type="text" name="name" autofocus />
      </div>

      <br />
      <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('kraina.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
