@extends('layouts.main')

@section('content')
<section class="gallery-section">

  <h1>Edytuj Miniaturkę galerii</h1>

  <x-errors />

  <form action="{{ route('galerie.update', $galerie->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div>
      <label for="name">Nazwa galerii:</label>
      <input type="text" name="name" autofocus value="{{ $galerie->name }}" />
    </div>
    <br />
    <div>
      <label for="thumbnail">Miniaturka:</label>
      <input type="file" name="thumbnail" />
      <input type="hidden" name="thumbnail" value="{{ $galerie->thumbnail }}">
    </div>
    <br />
    <br />

    <input type="submit" value="Edytuj" />
    <a href="{{ route('galerie.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
