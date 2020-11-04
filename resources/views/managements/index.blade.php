@extends('layouts.app')

@section('content')
  <section class="management-section">

    <h2>Zarząd koła łowieckiego</h2>

    <a href="{{ route('zarzad.create') }}">Dodaj członka</a>

    <x-alert msg="{{ Session::get('success') }}" />

    <br>

    @if( $managements->count() > 0 )

      <ul class="management-list unorder-list-styles-reset">
        @foreach( $managements as $management )
          <li class="management-list-item flex-column-center">
            <img class="management-img" src="{{ asset('storage/managements-img').'/'.$management->image }}" alt="członek zarządu koła łowieckiego" />
            <div class="management-name-surname">{{ $management->name }}</div>
            <div>
              <a href="#">Edytuj</a>
              <a href="#">Usuń</a>
            </div>
          </li>
          <br />
        @endforeach
      </ul>

    @else
      <div class="">Brak danych</div>
    @endif

  </section>
@endsection
