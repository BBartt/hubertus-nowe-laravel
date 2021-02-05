@extends('layouts.main')

@section('content')
<section class="decorations-titles-images-section create">

  <h1>Dodaj tytuły</h1>

  <x-errors />

  <form action="{{ route('odznaczenia_tytuly_zdjecia.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="title1">Pierwszy tytuł:</label> <br>
      <textarea name="title1" rows="8" cols="80"></textarea>
    </div>
    <br>
    <div>
      <label for="title2">Drugi tytuł:</label> <br>
      <textarea name="title2" rows="8" cols="80"></textarea>
    </div>

    <br>
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('odznaczenia.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
