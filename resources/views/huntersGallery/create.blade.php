@extends('layouts.main')

@section('content')
<section class="hunter-gallery-section">

  <h1>Dodaj Miniaturkę galerii myśliwego</h1>

  <x-errors />

  <form action="{{ route('galerie-mysliwego.store') }}" method="post" enctype="multipart/form-data">
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
    <a href="{{ route('galerie-mysliwego.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
