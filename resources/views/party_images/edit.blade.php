@extends('layouts.main')

@section('content')
<section class="images-section">

  <h1>Edytuj zdjęcie</h1>

  <x-errors />

  <form action="{{ route('imprezy_zdjecia.update', $image->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
      <label for="image">Zdjęcie:</label>
      <input type="file" name="image" />
    </div>

    <input type="hidden" name="party_id" value="{{ $image->party_id }}" >

    <br />
    <br />

    <input type="submit" value="Edytuj zdjęcie" />
    <a href="{{ route('imprezy.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
