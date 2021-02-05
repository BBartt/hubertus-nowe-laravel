@extends('layouts.main')

@section('content')
<section class="decorations-titles-images-section create">

  <h1>Edytuj tytułys</h1>

  <x-errors />

  <form action="{{ route('odznaczenia_tytuly_zdjecia.update', 1) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
      <label for="title1">Pierwszy tytuł:</label> <br>
      <textarea name="title1" rows="8" cols="80">{{ $id->title1 }}</textarea>
    </div>
    <br>
    <div>
      <label for="title2">Drugi tytuł:</label> <br>
      <textarea name="title2" rows="8" cols="80">{{ $id->title2 }}</textarea>
    </div>

    <br>
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('odznaczenia.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
