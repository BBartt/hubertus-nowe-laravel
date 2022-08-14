@extends('layouts.main')

@section('content')
<section class="trophy-gallery-section">

  <h1>Edytuj Miniaturkę galerii trofeów</h1>

  <x-errors />

  <form action="{{ route('trofea-galeria.update', $trofea_galerium->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div>
      <label for="name">Nazwa galerii:</label>
      <input type="text" name="name" autofocus value="{{ $trofea_galerium->name }}" />
    </div>
    <br />
    <div>
      <label for="thumbnail">Miniaturka:</label>
      <input type="file" name="thumbnail" />
      <input type="hidden" name="thumbnail" value="{{ $trofea_galerium->thumbnail }}">
    </div>
    <br />
    <br />

    <input type="submit" value="Edytuj" />
    <a href="{{ URL::previous() }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
