@extends('layouts.main')

@section('content')
  <section class="history-section">

  <h1>Edytuj dane do sekcji historia</h1>

  <x-errors />

  <form action="{{ route('historia.update', $historium->id) }}" method="post" >
    @csrf
    @method('patch')

    <div>
      <label for="description">Opis:</label> <br>
      <textarea name="description" rows="10" cols="100" autofocus>{{ $historium->description }}</textarea>
    </div>
    <br />
    <div>
      <label for="link1">Link 1:</label>
      <input name="link1" value="{{ $historium->link1 }}"></input>
      <label for="linkName1">Zawartość linku 1 (napis w który ma kliknąć użytkownik):</label>
      <input name="linkName1" value="{{ $historium->linkName1 }}"></input>
    </div>
    <br />
    <div>
      <label for="link2">Link 2:</label>
      <input name="link2" value="{{ $historium->link2 }}"></input>
      <label for="linkName2">Zawartość linku 2 (napis w który ma kliknąć użytkownik):</label>
      <input name="linkName2" value="{{ $historium->linkName2 }}"></input>
    </div>
    <br />
    <div>
      <label for="link3">Link 3:</label>
      <input name="link3" value="{{ $historium->link3 }}"></input>
      <label for="linkName3">Zawartość linku 3 (napis w który ma kliknąć użytkownik):</label>
      <input name="linkName3" value="{{ $historium->linkName3 }}"></input>
    </div>


    <br />
    <br />

    <input type="submit" value="Zaktualizuj" />
    <a href="{{ route('historia.index') }}" class="btn btn-link">Powrót</a>
  </form>


  <section>
@endsection
