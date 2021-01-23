@extends('layouts.main')

@section('content')
<section class="trophy-gallery-section">

  <h1>Dodaj Miniaturkę galerii</h1>

  <x-errors />

  <form action="{{ route('trofea-galeria.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="name">Nazwa galerii:</label>
      <input type="text" name="name" autofocus />
    </div>
    <br />
    <div>
      <label for="thumbnail">Miniaturka:</label>
      <input type="file" name="thumbnail" />
    </div>
    <br />
    <br />

    <input type="submit" value="Dodaj" />
    <a href="{{ route('trofea.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
