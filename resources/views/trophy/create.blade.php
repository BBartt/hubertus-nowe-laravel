@extends('layouts.main')

@section('content')
<section class="trophy-section create">

  <h1>Dodaj dane</h1>

  <x-errors />

  <form action="{{ route('trofea.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="not_trim_description">Opis:</label> <br>
      <textarea name="not_trim_description" rows="70" cols="100" autofocus></textarea>
    </div>

    <br />
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('trofea.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
