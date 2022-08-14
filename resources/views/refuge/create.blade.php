@extends('layouts.main')

@section('content')
  <section class="refuge-section create">

    <h1>Dodaj dane do sekcji ostoja</h1>

    <x-errors />

    <form action="{{ route('ostoja.store') }}" method="post" >
      @csrf

      <div>
        <label for="description">Opis:</label> <br>
        <textarea name="description" rows="8" cols="80" autofocus></textarea>
      </div>

      <br />
      <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('ostoja.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
