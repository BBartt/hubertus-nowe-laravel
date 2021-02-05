@extends('layouts.main')

@section('content')
<section class="history-section edit">

  <h1>Edytuj zdjęcie</h1>

  <x-errors />

  <form action="{{ route('historia_zdjecia.update', $image->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
      <label for="image">Zdjęcie:</label>
      <input type="file" name="image" />
    </div>

    <input type="hidden" name="history_id" value="{{ $image->history_id }}" >

    <br />
    <br />

    <input type="submit" value="Edytuj zdjęcie" />
    <a href="{{ route('historia.index') }}" class="btn btn-link">Powrót</a>
  </form>

</section>
@endsection
