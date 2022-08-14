@extends('layouts.main')

@section('content')
  <section class="refuge-section edit">

    <h1>Edytuj dane do sekcji ostoja</h1>

    <x-errors />

    <form action="{{ route('ostoja.update', $ostoja->id) }}" method="post" >
      @csrf
      @method('put')

      <div>
        <label for="description">Opis:</label> <br>
        <textarea name="description" rows="10" cols="100" autofocus>{{ $ostoja->description }}</textarea>
      </div>

      <br />
      <br />

      <input type="submit" value="Zaktualizuj" />
      <a href="{{ route('ostoja.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
