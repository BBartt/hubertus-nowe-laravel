@extends('layouts.main')

@section('content')
<section class="party_images-section">

  <h1>Dodaj zdjęcia</h1>

  <x-errors />

  <form action="{{ route('imprezy_zdjecia.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="images[]">Zdjęcia:</label>
      <input type="file" name="images[]" multiple />
    </div>
    <input type="hidden" name="party_id" value="{{ $party_id }}" >
    <br />
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('imprezy.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
