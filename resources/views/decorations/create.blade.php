@extends('layouts.main')

@section('content')
<section class="decorations-section create">

  <h1>Dodaj dane</h1>

  <x-errors />

  <form action="{{ route('odznaczenia.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="title1">Pierwszy tytuł:</label> <br>
      <input name="title1" autofocus></input>
    </div>
    <br>
    <div>
      <label for="title2">Drugi tytuł:</label> <br>
      <input name="title2"></input>
    </div>
    <br />

    <div>
      <label for="not_trim_description">Opis:</label> <br>
      <textarea name="not_trim_description" rows="70" cols="100"></textarea>
    </div>

    <br />
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('odznaczenia.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
