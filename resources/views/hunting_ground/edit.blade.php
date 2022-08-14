@extends('layouts.main')

@section('content')
<section class="hunting-ground-section">

  <h1>Edytuj zdjęcie</h1>

  <x-errors />

  <form action="{{ route('lowiska.update', $image->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")

    <div>
      <label for="image">Zdjęcia:</label>
      <input type="file" name="image" />
    </div>
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('lowiska.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
