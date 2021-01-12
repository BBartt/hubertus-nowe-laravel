@extends('layouts.main')

@section('content')
  <section class="party-section">

    <h1>Dodaj dane do sekcji myśliwi dla was</h1>

    <x-errors />

    <form action="{{ route('imprezy.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="description">Opis:</label> <br>
        <textarea name="description" rows="8" cols="80" autofocus></textarea>
      </div>
      <div>
        <label for="link_1">Link 1:</label>
        <input type="text" name="link_1" />
      </div>
      <div>
        <label for="link_2">Link 2:</label>
        <input type="text" name="link_2" />
      </div>
      <div>
        <label for="link_3">Link 3:</label>
        <input type="text" name="link_3" />
      </div>
      <div>
        <label for="link_4">Link 4:</label>
        <input type="text" name="link_4" />
      </div>
      <div>
        <label for="link_5">Link 5:</label>
        <input type="text" name="link_5" />
      </div>

      <br />
      <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('imprezy.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
