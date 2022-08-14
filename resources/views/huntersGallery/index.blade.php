@extends('layouts.main')

@section('content')
<section class="hunter-gallery-section index">

  <h1>Galeria zdjęć dla Myśliwego</h1>

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('galerie-mysliwego.create') }}">Dodaj galerię</a>
  @endif

  <br />

  <x-alert msg="{{ Session::get('success') }}" />

  @if( count($galleries) > 0 )
    <div class="galleries-wrapper">
      @foreach( $galleries as $gallery )

        <div class="gallery">
          <a href="{{ route('galerie-mysliwego.show', $gallery->id)  }}" class="flex-column">
            <img
              class="gallery-thumbnail"
              src="{{ asset('storage/hunters-galleries/thumbnails').'/'.$gallery->thumbnail }}"
              alt="{{ $gallery->name }}"
            />
            <h1>{{ $gallery->name }}</h1>
          </a>
          @if(Auth::check() && Auth::user()->name == 'admin')
            <div class="flex-row-center">
              <a href="{{ route('galerie-mysliwego.edit', $gallery->id) }}">Edytuj</a>
              <form action="{{ route('galerie-mysliwego.destroy', $gallery->id) }}" method="POST">
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
