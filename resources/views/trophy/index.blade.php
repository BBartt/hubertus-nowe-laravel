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

</section>
@endsection
