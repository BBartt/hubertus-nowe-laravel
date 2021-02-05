@extends('layouts.main')

@section('content')
<section class="decorations-section index">

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('odznaczenia.create') }}">Dodaj dane</a>
    @if( !$data )
      <a href="{{ route('odznaczenia_tytuly_zdjecia.create', 1) }}">Dodaj tytułu i/lub zdjęcia</a>
    @endif
    <br>
  @endif

  @if( $data )
    <div class="decorations-wrapper flex-column">

      @if( $data->title1 )
        <h3>{!! nl2br(e($data->title1)) !!}</h3>
      @endif
      @if( $data->title2 )
        <h3>{!! nl2br(e($data->title2)) !!}</h3>
      @endif

      @if(Auth::check() && Auth::user()->name == 'admin')
        <div class="actions flex-row-center">
          <a href="{{ route('odznaczenia_tytuly_zdjecia.edit', 1) }}">Edytuj</a>
          <form action="{{ route('odznaczenia_tytuly_zdjecia.destroy', 1) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">usuń</button>
          </form>
        </div>
      @endif

    </div>
  @endif

  @if( count($decorations) > 0 )
    <div class="decorations-wrapper flex-column">
      @foreach( $decorations as $decoration )

        <div>{!! nl2br(e($decoration->not_trim_description)) !!}</div>

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
