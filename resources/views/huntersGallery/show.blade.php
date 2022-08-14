@extends('layouts.main')

@section('content')
<section class="hunter-gallery-section show">

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('zdjecia-galerii-mysliwego.create', $gallery->id) }}">Dodaj zdjęcia</a>
    <br />
    <a href="{{ route('galerie-mysliwego.index') }}">Powrót</a>
    <br />
  @endif
  <br />

  <x-alert msg="{{ Session::get('success') }}" />

  @if( count($gallery->images) > 0 )
    <div class="images-wrapper">
      <div class="hes-gallery">
        @foreach( $gallery->images as $image )
          <div class="image-wrapper">
            <img
              class="gallery-image"
              src="https://hubertus-nowe.pl/storage/hunters-galleries/gallery__images-6/1838035601__key-1___20170121_122545 - Kopia.jpg"
            />
            <p>{{ $image->description }}</p>

            <div class="flex-row-center">
              @if(Auth::check() && Auth::user()->name == 'admin')
                <a href="{{ route('zdjecia-galerii-mysliwego.edit', $image->id) }}">Edytuj</a>
                <form action="{{ route('zdjecia-galerii-mysliwego.destroy', $image->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="delete-btn">usuń</button>
                </form>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @else
    <div>Brak zdjęć</div>
  @endif

</section>
@endsection
