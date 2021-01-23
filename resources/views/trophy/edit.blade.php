@extends('layouts.main')

@section('content')
<section class="trophy-section edit">

  <h1>Edytuj dane</h1>

  <x-errors />

  <form action="{{ route('trofea.update', $trofea->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
      <label for="not_trim_description">Opis:</label> <br>
      <textarea name="not_trim_description" rows="70" cols="100" autofocus>{{ $trofea->not_trim_description }}</textarea>
    </div>

    <br />
    <br />

    <input type="submit" value="Zaktualizuj" />
    <a href="{{ route('trofea.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
