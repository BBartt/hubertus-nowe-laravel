@extends('layouts.main')

@section('content')
<section class="trophy-gallery-section show">
  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('zdjecia-galerii-trofea.create', $gallery->id) }}">Dodaj zdjęcia</a>
  @endif
  <br />
  <a href="{{ route('trofea.index') }}" class="btn btn-link">Powrót</a>
  <x-alert msg="{{ Session::get('success') }}" />

  @if( $gallery->name )
    <h1>{{ $gallery->name }}</h1>
  @endif

  @if( count($gallery->images) > 0 )
    <div class="images-wrapper">
      <div class="hes-gallery">
        @foreach( $gallery->images as $image )
          <div class="image-wrapper">
            <img
              class="gallery-image"
              src="{{ asset('storage/trofea_galeria/gallery__images')."-".$image->trophy_gallery_id."/".$image->image }}"
            />
            <p>{{ $image->description }}</p>

            <div class="flex-row-center">
              @if(Auth::check() && Auth::user()->name == 'admin')
                <a href="{{ route('zdjecia-galerii-trofea.edit', $image->id) }}">Edytuj</a>
                <form action="{{ route('zdjecia-galerii-trofea.destroy', $image->id) }}" method="POST">
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
