@extends('layouts.main')

@section('content')
<section class="refuge-section edit">

  <h1>Edytuj zdjęcie</h1>

  <x-errors />

  <form action="{{ route('ostoja_zdjecia.update', $image->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
      <label for="image">Zdjęcie:</label>
      <input type="file" name="image" />
    </div>

    <input type="hidden" name="refuge_id" value="{{ $image->refuge_id }}" >

    <br />
    <br />

    <input type="submit" value="Edytuj zdjęcie" />
    <a href="{{ route('ostoja.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
