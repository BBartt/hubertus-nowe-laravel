@extends('layouts.main')

@section('content')
<section class="venison-section">

  <h1>Dodaj produkt</h1>

  <x-errors />

  <form action="{{ route('dziczyzna.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="image">Zdjęcie:</label>
      <input type="file" name="image" multiple />
    </div>
    <div>
      <label for="name">Nazwa:</label>
      <input type="text" name="name" multiple />
    </div>
    <div>
      <label for="interval">Okres:</label>
      <input type="text" name="interval" multiple />
    </div>
    <div>
      <label for="price">Cena:</label>
      <input type="text" name="price" multiple />
    </div>

    <br />
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('dziczyzna.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
