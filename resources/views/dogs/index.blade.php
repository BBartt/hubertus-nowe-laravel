@extends('layouts.main')

@section('content')
  <section class="dogs-section">

    <h2>Nasze psy</h2>

    @if(Auth::check() && Auth::user()->name == 'admin')
      <a class="link" href="{{ route('psy.create') }}">Dodaj psa</a>
    @endif

    <x-alert msg="{{ Session::get('success') }}" />

    <br>

    @if( $dogs->count() > 0 )
      <ul class="dogs-list unorder-list-styles-reset">
        @foreach( $dogs as $dog )
          <li class="dogs-list-item hes-gallery flex-column-center">
            <img class="dog-img" src="{{ asset('storage/our_dogs').'/'.$dog->image }}" alt="pies koła" />
            <div class="dog-name-surname">{{ $dog->description }}</div>
            <div class="flex-row-center">
              @if(Auth::check() && Auth::user()->name == 'admin')
                <a href="{{ route('psy.edit', $dog->id) }}">Edytuj</a>
                <form action="{{ route('psy.destroy', $dog->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="delete-btn">usuń</button>
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
