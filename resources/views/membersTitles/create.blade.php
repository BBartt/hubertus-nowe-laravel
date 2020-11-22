@extends('layouts.main')

@section('content')
  <section class="membersTitles-section">

    <h1>Dodaj tytuły</h1>

    <x-errors />

    <form action="{{ route('membersTitles.store') }}" method="post" enctype="multipart/form-data">
      @csrf

      <textarea name="title1" rows="8" cols="80"></textarea>
      <br>
      <textarea name="title2" rows="8" cols="80"></textarea>

      <br /> <br />

      <input type="submit" value="Dodaj" />
      <a href="{{ route('membersTitles.index') }}" class="btn btn-link">Powrót</a>
    </form>

  <section>
@endsection
