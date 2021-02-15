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

        <div class="hes-gallery">
          @if( $decoration->img1 )
            <img
              class="img"
              src="{{ asset('storage/decorations__images')."/".$decoration->img1 }}"
              alt="{{ $decoration->img1 }}"
            />
          @endif
          @if( $decoration->img2 )
            <img
              class="img"
              src="{{ asset('storage/decorations__images')."/".$decoration->img2 }}"
              alt="{{ $decoration->img2 }}"
            />
          @endif
          @if( $decoration->img3 )
            <img
              class="img"
              src="{{ asset('storage/decorations__images')."/".$decoration->img3 }}"
              alt="{{ $decoration->img3 }}"
            />
          @endif
          @if( $decoration->img4 )
            <img
              class="img"
              src="{{ asset('storage/decorations__images')."/".$decoration->img4 }}"
              alt="{{ $decoration->img4 }}"
            />
          @endif
          @if( $decoration->img5 )
            <img
              class="img"
              src="{{ asset('storage/decorations__images')."/".$decoration->img5 }}"
              alt="{{ $decoration->img5 }}"
            />
          @endif
        </div>



        @if(Auth::check() && Auth::user()->name == 'admin')
          <div class="actions flex-row-center">
            <a href="{{ route('odznaczenia.edit', $decoration->id) }}">Edytuj</a>
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
