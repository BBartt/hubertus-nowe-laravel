@extends('layouts.main')

@section('content')
<section class="trophy-gallery-images-section">

  <h1>Dodaj zdjęcia</h1>

  <x-errors />

  <form action="{{ route('zdjecia-galerii-trofea.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="images[]">Zdjęcia:</label>
      <input type="file" name="images[]" multiple />
    </div>
    <input type="hidden" name="trophy_gallery_id" value="{{ $trophy_gallery_id }}" >
    <br />
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('trofea-galeria.show', $trophy_gallery_id) }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
