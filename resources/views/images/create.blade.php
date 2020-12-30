@extends('layouts.main')

@section('content')
<section class="images-section">

  <h1>Dodaj zdjęcia</h1>

  <x-errors />

  <form action="{{ route('zdjecia.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="images[]">Zdjęcia:</label>
      <input type="file" name="images[]" multiple />
    </div>
    <input type="hidden" name="gallery_id" value="{{ $gallery_id }}" >
    <br />
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('galerie.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
