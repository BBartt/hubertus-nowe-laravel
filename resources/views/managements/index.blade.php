@extends('layouts.app')

@section('content')
  <h2>Zarząd koła łowieckiego</h2>

  <a href="{{ route('zarzad.create') }}">Dodaj członka</a>

  <x-alert msg="{{ Session::get('success') }}" />

  <br>

  @if( $managements->count() > 0 )
    <ul class="management-list unorder-list-styles-reset">
      @foreach( $managements as $management )
        <li class="management-list-item flex-column-center">
          <img style="width: 200px;" src="{{ asset('storage/images/'.$management->image) }}" alt="">
          <span>{{ $management->name }}</span>
          <div>
            <a href="#">Edytuj</a>
            <a href="#">Usuń</a>
          </div>
        </li>
      @endforeach
    </ul>
  @else
    <div class="">
      Brak danych
    </div>
  @endif

@endsection
