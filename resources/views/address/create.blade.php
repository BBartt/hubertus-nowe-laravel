@extends('layouts.main')

@section('content')
<section class="address-section flex-column-center">

  <h1>Dodaj adres</h1>

  <x-errors />

  <form action="{{ route('adres.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="address">Adres:</label> <br>
      <textarea name="address" rows="8" cols="80" autofocus></textarea>
    </div>
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('galerie.index') }}" class="btn btn-link">Powrót</a>
  </form>


</section>
@endsection
