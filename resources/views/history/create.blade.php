@extends('layouts.main')

@section('content')
  <section class="history-section">

    <h1>Dodaj dane do sekcji ostoja</h1>

    <x-errors />

    <form action="{{ route('historia.store') }}" method="post" >
      @csrf

      <div>
        <label for="description">Opis:</label> <br>
        <textarea name="description" rows="8" cols="80" autofocus></textarea>
      </div>
      <br />
      <div>
        <label for="link1">Link 1:</label>
        <input name="link1"></input>
        <label for="linkName1">Zawartość linku 1 (napis w który ma kliknąć użytkownik):</label>
        <input name="linkName1"></input>
      </div>

      <br />
      <br />

      <div>
        <label for="link2">Link 2:</label>
        <input name="link2"></input>
        <label for="linkName2">Zawartość linku 2 (napis w który ma kliknąć użytkownik):</label>
        <input name="linkName2"></input>
      </div>

      <br />
      <br />

      <div>
        <label for="link2">Link 2:</label>
        <input name="link2"></input>
        <label for="linkName2">Zawartość linku 3 (napis w który ma kliknąć użytkownik):</label>
        <input name="linkName2"></input>
      </div>

      <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('ostoja.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
