@extends('layouts.main')

@section('content')
  <div class="messages-section">

    <h1>Dodaj komunikat</h1>

    <x-errors />

    <form action="{{ route('komunikaty.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div>
        <label for="title">Tytuł komunikatu:</label> <br>
        <input type="text" name="title" />
      </div>
      <div>
        <label for="description">Opis:</label> <br>
        <textarea name="description" rows="10" cols="100"></textarea>
      </div>
      <div>
        <label for="image">Zdjęcie:</label>
        <input type="file" name="image" />
      </div>

      <hr />

      <div>
        <label for="link">Opcjonalny link u dołu komunikatu:</label>
        <input type="text" name="link" />
      </div>
      <div>
        <label for="linkName">Opcjonalna zawartość linku (nazwa w którą kliknie myśliwy):</label>
        <input type="text" name="linkName" />
      </div>

      <br />
      <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('komunikaty.index') }}" class="btn btn-link">Powrót</a>
    </form>


  </div>
@endsection
