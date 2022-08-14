@extends('layouts.main')

@section('content')
<section class="address-section flex-column-center">

  <h1>Edytuj adres</h1>

  <x-errors />

  <form action="{{ route('adres.update', $adre->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")

    <div>
      <label for="address">Adres:</label> <br>
      <textarea name="address" rows="8" cols="80" autofocus>{{ $adre->address }}</textarea>
    </div>
    <br />

    <input type="submit" value="Edytuj" />
    <a href="{{ route('adres.index') }}" class="btn btn-link">Powrót</a>
  </form>


</section>
@endsection
