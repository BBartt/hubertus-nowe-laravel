@extends('layouts.main')

@section('content')
<section class="decorations-section index">

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('odznaczenia.create') }}">Dodaj dane</a>
    <br>
  @endif

  @if( count($decorations) > 0 )
    <div class="decorations-wrapper flex-column">
      @foreach( $decorations as $decoration )

        @if( $decoration->title1 )
          <h3>{!! nl2br(e($decoration->title1)) !!}</h3>
        @endif
        @if( $decoration->title2 )
          <h3>{!! nl2br(e($decoration->title2)) !!}</h3>
        @endif

        <div class="description">{!! nl2br(e($decoration->not_trim_description)) !!}</div>

        @if( count($decoration->images) > 0 )
            <div class="hes-gallery">
              @foreach( $decoration->images as $image )
                <div class="image-wrapper">
                  <img
                    class="img"
                    src="{{ asset('storage/decorations/decorations__images-').$image->decoration_id."/".$image->image }}"
                    alt="{{ $image->img1 }}"
                  />
                  <div class="flex-row-center">
                    @if(Auth::check() && Auth::user()->name == 'admin')
                      <a href="{{ route('odznaczenia_zdjecia.edit', $image->id) }}">Edytuj</a>
                      <form action="{{ route('odznaczenia_zdjecia.destroy', $image->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">usuń</button>
                      </form>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
        @endif

        @if(Auth::check() && Auth::user()->name == 'admin')
          <div class="actions flex-row-center">
            <a href="{{ route('odznaczenia.edit', $decoration->id) }}">Edytuj</a>
            &nbsp; &nbsp; - &nbsp; &nbsp;
            <a href="{{ route('odznaczenia_zdjecia.create', $decoration->id) }}">Dodaj zdjecia</a>
            &nbsp; &nbsp; - &nbsp; &nbsp;
            <form action="{{ route('odznaczenia.destroy', $decoration->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="delete-btn">usuń</button>
            </form>
          </div>
        @endif
      @endforeach
    </div>
  @else
    <h1>Brak danych</h1>
  @endif

</section>
@endsection
