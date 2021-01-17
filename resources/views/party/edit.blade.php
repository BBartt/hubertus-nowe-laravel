@extends('layouts.main')

@section('content')
  <div class="party-section edit">

    <h1>Edytuj komunikat</h1>

    <x-errors />

    <form action="{{ route('imprezy.update', $imprezy->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')

      <div>
        <label for="description">Opis:</label> <br>
        <textarea name="description" rows="10" cols="100">{{ $imprezy->description }}</textarea>
      </div>
      
      <br />
      <br />

      <input type="submit" value="Zaktualiuj" />
      <a href="{{ route('imprezy.index') }}" class="btn btn-link">Powrót</a>
    </form>


  </div>
@endsection
