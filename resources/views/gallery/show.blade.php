@extends('layouts.main')

@section('content')
<section class="gallery-section show">
  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="/zdjecia/create/{{ $gallery->id }}">Dodaj zdjęcia</a>
  @endif
  <br />
  <a href="{{ route('galerie.index') }}" class="btn btn-link">Powrót</a>
  <x-alert msg="{{ Session::get('success') }}" />

  @if( count($gallery->images) > 0 )
    <div class="images-wrapper">
      @foreach( $gallery->images as $image )
        <div class="image-wrapper">
          <img
            class="gallery-image"
            src="{{ asset('storage/galleries/gallery__images')."-".$image->gallery_id."/".$image->image }}"
          />
          <p>{{ $image->description }}</p>

          <div class="flex-row-center">
            @if(Auth::check() && Auth::user()->name == 'admin')
              <a href="{{ route('zdjecia.edit', $image->id) }}">Edytuj</a>
              <form action="{{ route('zdjecia.destroy', $image->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">usuń</button>
              </form>
            @endif
          </div>

        </div>
      @endforeach
    </div>
  @else
    <div>Brak zdjęć</div>
  @endif

</section>
@endsection
