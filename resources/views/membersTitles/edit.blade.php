@extends('layouts.main')

@section('content')
  <section class="membersTitles-section">

    <h1>Edycja tytułów</h1>

    <x-errors />

    <form action="{{ route('membersTitles.update', 1) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <textarea name="title1" rows="8" cols="80">{{ $membersTitle->title1 }}</textarea>
      <br>
      <textarea name="title2" rows="8" cols="80">{{ $membersTitle->title2 }}</textarea>

      <br />
      <br />

      <input type="submit" value="Edytuj" />
      <a href="{{ route('czlonkowie_kola.index') }}" class="btn btn-link">Powrót</a>
    </form>
  <section>
@endsection
