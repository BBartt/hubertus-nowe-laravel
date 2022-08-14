@extends('layouts.main')

@section('content')
<section class="trophy-section index flex-column-center">

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('trofea.create') }}">Dodaj trofeum</a>
    <br>
  @endif

  @if( count($trophies) > 0 )
    <div class="trophies-wrapper flex-column">
      @foreach( $trophies as $trophy )
        <div>{!! nl2br(e($trophy->not_trim_description)) !!}</div>

        @if(Auth::check() && Auth::user()->name == 'admin')
          <div class="actions flex-row-center">
            <a href="{{ route('trofea.edit', $trophy->id) }}">Edytuj</a>
            <form action="{{ route('trofea.destroy', $trophy->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="delete-btn">usuń</button>
            </form>
          </div>
        @endif

      @endforeach
    </div>
  @else
    <h1>Brak trofeów</h1>
  @endif

  <br>

  <section class="trophy-images-section">
    @if(Auth::check() && Auth::user()->name == 'admin')
      <br>
      <a href="{{ route('trofea-galeria.create') }}">Dodaj miniaturkę galerii</a>
      <br>
      <br>
    @endif

    @if( count($galleries) > 0 )
      <div class="galleries-wrapper">
        @foreach( $galleries as $gallery )
          <div class="gallery">
            <a href="/trofea-galeria/{{ $gallery->id }}" class="gallery-link flex-column">
              <img
                class="gallery-thumbnail"
                src="{{ asset('storage/trofea_galeria/thumbnails').'/'.$gallery->thumbnail }}"
                alt="{{ $gallery->name }}"
              />
              <h1>{{ $gallery->name }}</h1>
            </a>
            @if(Auth::check() && Auth::user()->name == 'admin')
              <div class="flex-row-center">
                <a href="{{ route('trofea-galeria.edit', $gallery->id) }}">Edytuj</a>
                <form action="{{ route('trofea-galeria.destroy', $gallery->id) }}" method="POST">
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
      <div>Brak zdjęć</div>
    @endif
  </section>


</section>
@endsection
