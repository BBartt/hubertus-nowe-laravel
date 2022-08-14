@extends('layouts.main')

@section('content')
<section class="hunting-ground-section hes-gallery">
  <h1>Łowiska</h1>

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('lowiska.create') }}">Dodaj zdjęcia</a>
  @endif

  <br />

  <x-alert msg="{{ Session::get('success') }}" />

  @if( count($images) > 0 )
    <div class="images-wrapper">
      @foreach( $images as $image )

        <div class="image">
          <img
            class="image"
            src="{{ asset('storage/hunting_ground').'/'.$image->image }}"
            alt="{{ $image->name }}"
          />
          @if(Auth::check() && Auth::user()->name == 'admin')
            <div class="flex-row-center">
              <a href="{{ route('lowiska.edit', $image->id) }}">Edytuj</a>
              <form action="{{ route('lowiska.destroy', $image->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">usuń</button>
              </form>
            </div>
          @endif
        </div>

      @endforeach
    </div>
  @else
    <div>Brak galerii</div>
  @endif


</section>
@endsection
