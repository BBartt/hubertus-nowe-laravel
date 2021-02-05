@extends('layouts.main')

@section('content')
<section class="hunting-ground-section">

  <h1>Dodaj zdjęcia</h1>

  <x-errors />

  <form action="{{ route('lowiska.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="images[]">Zdjęcia:</label>
      <input type="file" name="images[]" multiple />
    </div>
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('lowiska.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
