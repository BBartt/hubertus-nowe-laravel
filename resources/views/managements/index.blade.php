@extends('layouts.main')

@section('content')
  <section class="management-section">

    <h2>Zarząd koła łowieckiego</h2>

    @if(Auth::check() && Auth::user()->name == 'admin')
      <a class="link" href="{{ route('zarzad.create') }}">Dodaj członka</a>
    @endif

    <x-alert msg="{{ Session::get('success') }}" />

    <br>

    @if( $managements->count() > 0 )
      <ul class="management-list unorder-list-styles-reset">
        @foreach( $managements as $management )
          <li class="management-list-item flex-column-center">
            <img class="management-img" src="{{ asset('storage/managements-img').'/'.$management->image }}" alt="członek zarządu koła łowieckiego" />
            <div class="management-name-surname">{{ $management->name }}</div>
            <div>
              @if(Auth::check() && Auth::user()->name == 'admin')
                <a href="{{ route('zarzad.edit', $management->id) }}">Edytuj</a>
                <form action="{{ route('zarzad.destroy', $management->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="border: none; background-color:#dc3545;color:white;">usuń</button>
                </form>
              @endif
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
