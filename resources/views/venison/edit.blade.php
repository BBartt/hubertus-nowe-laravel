@extends('layouts.main')

@section('content')
<section class="venison-section">

  <h1>Edycja produktu</h1>

  <x-errors />

  <form action="{{ route('dziczyzna.update', $dziczyzna->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
      <label for="image">Zdjęcie:</label>
      <input type="file" name="image" />
      <input type="hidden" name="image" value="{{ $dziczyzna->image }}" >
    </div>

    <div>
      <label for="name">Nazwa:</label>
      <input type="text" name="name" value="{{ $dziczyzna->name }}" />
    </div>

    <div>
      <label for="interval">Okres:</label>
      <input type="text" name="interval" value="{{ $dziczyzna->interval }}" />
    </div>

    <div>
      <label for="price">Cena:</label>
      <input type="text" name="price" value="{{ $dziczyzna->price }}" />
    </div>

    <br />
    <br />

    <input type="submit" value="Edytuj zdjęcia" />
    <a href="{{ route('galerie.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
