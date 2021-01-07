@extends('layouts.main')

@section('content')
  <section class="dogs-section">

    <h1>Edycja psa</h1>

    <x-errors />

    <form action="{{ route('psy.update', $psy->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <div>
        <label for="image">Zdjęcie:</label>
        <input type="file" name="image" />
      </div>
      <br />
      <div>
        <label for="description">Opis pod zdjęciem:</label>
        <input type="text" name="description" autofocus value="{{ $psy->description }}" />
      </div>

      <br />
      <br />

      <input type="submit" value="Edytuj" />
      <a href="{{ route('psy.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
