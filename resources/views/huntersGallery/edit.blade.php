@extends('layouts.main')

@section('content')
<section class="hunter-gallery-section">

  <h1>Edytuj Miniaturkę galerii myśliwego</h1>

  <x-errors />

  <form action="{{ route('galerie-mysliwego.update', $galerie_mysliwego->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div>
      <label for="name">Nazwa galerii:</label>
      <input type="text" name="name" autofocus value="{{ $galerie_mysliwego->name }}" />
    </div>
    <br />
    <div>
      <label for="thumbnail">Miniaturka:</label>
      <input type="file" name="thumbnail" />
      <input type="hidden" name="thumbnail" value="{{ $galerie_mysliwego->thumbnail }}">
    </div>
    <br />
    <br />

    <input type="submit" value="Edytuj" />
    <a href="{{ route('galerie-mysliwego.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
