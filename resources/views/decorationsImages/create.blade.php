@extends('layouts.main')

@section('content')
<section class="decorations-images-section">

  <h1>Dodaj zdjęcia</h1>

  <x-errors />

  <form action="{{ route('odznaczenia_zdjecia.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="images[]">Zdjęcia:</label>
      <input type="file" name="images[]" multiple />
    </div>
    <input type="hidden" name="decoration_id" value="{{ $decoration_id }}" >
    <br />
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('odznaczenia.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
