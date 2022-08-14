@extends('layouts.main')

@section('content')
<div class="standard-section hes-gallery">

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a class="link" href="{{ route('sztandar.create') }}">Dodaj dane</a>
  @endif

  <x-alert msg="{{ Session::get('success') }}" />

  <br>

  @if( $standards->count() > 0 )
    <ul class="standard-list unorder-list-styles-reset">
      @foreach( $standards as $standard )
        <li class="standard-list-item flex-column-center">
          <h3 class="standard-title">{{ $standard->title }}</h3>
          <img
            class="standard-img"
            src="{{ asset('storage/standard-img').'/'.$standard->image }}"
            alt="członek zarządu koła łowieckiego"
          />
          <div>
            @if(Auth::check() && Auth::user()->name == 'admin')
              <a href="{{ route('sztandar.edit', $standard->id) }}">Edytuj</a>
              <form action="{{ route('sztandar.destroy', $standard->id) }}" method="POST">
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

</div>
@endsection
