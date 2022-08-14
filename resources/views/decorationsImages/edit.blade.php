@extends('layouts.main')

@section('content')
<section class="decorations-images-section">

  <h1>Edytuj zdjęcie</h1>

  <x-errors />

  <form action="{{ route('odznaczenia_zdjecia.update', $image->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
      <label for="image">Zdjęcie:</label>
      <input type="file" name="image" />
    </div>

    <br />
    <br />

    <input type="submit" value="Edytuj zdjęcie" />
    <a href="{{ route('odznaczenia.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
