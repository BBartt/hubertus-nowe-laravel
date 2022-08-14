@extends('layouts.main')

@section('content')
  <div class="party-section edit">

    <h1>Edytuj komunikat</h1>

    <x-errors />

    <form action="{{ route('imprezy.update', $imprezy->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')

      <div>
        <label for="description">Opis:</label> <br>
        <textarea name="description" rows="10" cols="100">{{ $imprezy->description }}</textarea>
      </div>

      <div>
        <label for="link_1">link_1: </label> <br>
        <input name="link_1" value="{{ $imprezy->link_1 }}" />
      </div>

      <div>
        <label for="link_2">link_2: </label> <br>
        <input name="link_2" value="{{ $imprezy->link_2 }}" />
      </div>
      

      <div>
        <label for="link_3">link_3: </label> <br>
        <input name="link_3" value="{{ $imprezy->link_3 }}" />
      </div>
      

      <div>
        <label for="link_4">link_4: </label> <br>
        <input name="link_4" value="{{ $imprezy->link_4 }}" />
      </div>
      

      <div>
        <label for="link_5">link_5: </label> <br>
        <input name="link_5" value="{{ $imprezy->link_5 }}" />
      </div>
      
      <br />
      <br />

      <input type="submit" value="Zaktualiuj" />
      <a href="{{ route('imprezy.index') }}" class="btn btn-link">Powrót</a>
    </form>


  </div>
@endsection
