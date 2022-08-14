@extends('layouts.main')

@section('content')
<section class="hunters-images-section">

  <h1>Edytuj zdjęcie</h1>

  <x-errors />

  <form action="{{ route('zdjecia-galerii-mysliwego.update', $image->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
      <label for="image">Zdjęcie:</label>
      <input type="file" name="image" />
    </div>

    <div>
      <label for="description">Opcjonalny opis pod zdjęciem:</label>
      <input type="text" name="description" value="{{ $image->description }}" />
    </div>

    <input type="hidden" name="hunters_gallery_id" value="{{ $image->hunters_gallery_id }}" >
    <input type="hidden" name="image" value="{{ $image->image }}" >

    <br />
    <br />

    <input type="submit" value="Edytuj zdjęcie" />
    <a href="{{ route('galerie.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
