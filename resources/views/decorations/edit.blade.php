@extends('layouts.main')

@section('content')
<section class="decorations-section edit">

  <h1>Edytuj dane</h1>

  <x-errors />

  <form action="{{ route('odznaczenia.update', $odznaczenium->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
      <label for="title1">Pierwszy tytuł:</label> <br>
      <input name="title1" value="{{ $odznaczenium->title1 }}" />
    </div>
    <br>
    <div>
      <label for="title2">Drugi tytuł:</label> <br>
      <input name="title2" value="{{ $odznaczenium->title2 }}" />
    </div>
    <br />

    <div>
      <label for="not_trim_description">Opis:</label> <br>
      <textarea name="not_trim_description" rows="70" cols="100" >{{ $odznaczenium->not_trim_description }}</textarea>
    </div>

    <br />
    <br />

    <input type="submit" value="Zaktualizuj" />
    <a href="{{ route('odznaczenia.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
