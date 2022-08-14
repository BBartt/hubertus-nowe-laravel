@extends('layouts.main')

@section('content')
<section class="history-section">
  <h1>Historia Koła</h1>

  <h4>RYS HISTORYCZNY KOŁA ŁOWIECKIEGO NR 87 HUBERTUS W NOWEM</h4>

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a class="link" href="{{ route('historia.create') }}">Dodaj dane</a>
  @endif

  <x-alert msg="{{ Session::get('success') }}" />

  <br>

  @if( $histories->count() > 0 )
    <ul class="history-list unorder-list-styles-reset">
      @foreach( $histories as $history )
        <li class="histories-list-item flex-column-center">

          <p>{!! nl2br(e($history->description)) !!}</p>

          @if($history->link1)
            <a target="_blank" href="{{ $history->link1 }}">{{ $history->linkName1 ?: "Link" }}</a>
          @endif

          @if(count($history->historyImages) > 0)
            <div class="hes-gallery images-wrapper flex-row-center">
              @foreach( $history->historyImages as $image )
                <div>
                  <img
                    class="history-image"
                    src="{{ asset('storage/history__images-').$image->history_id."/".$image->image }}"
                  />
                  @if(Auth::check() && Auth::user()->name == 'admin')
                    <br />
                    <div class="flex-row-center">
                      <a href="{{ route('historia_zdjecia.edit', $image->id) }}">Edytuj zdjęcie</a>
                      &nbsp; &nbsp; - &nbsp; &nbsp;
                      <form action="{{ route('historia_zdjecia.destroy', $image->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">usuń</button>
                      </form>
                    </div>
                  @endif
                </div>
              @endforeach
            </div>
          @endif

          @if($history->link2)
            <a target="_blank" href="{{ $history->link2 }}">{{ $history->linkName2 ?: "Link" }}</a>
          @endif
          @if($history->link3)
            <a target="_blank" href="{{ $history->link3 }}">{{ $history->linkName3 ?: "Link" }}</a>
          @endif

          @if(Auth::check() && Auth::user()->name == 'admin')
            <br />
            <div class="flex-row-center">
              <a href="{{ route('historia.edit', $history->id) }}">Edytuj tekst</a>
              &nbsp; &nbsp; - &nbsp; &nbsp;
              <a href="{{ route('historia_zdjecia.create', $history->id) }}">Dodaj zdjęcia</a>
              &nbsp; &nbsp; - &nbsp; &nbsp;
              <form action="{{ route('historia.destroy', $history->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">usuń</button>
              </form>
            </div>
          @endif

        </li>
        <br />
      @endforeach
    </ul>
  @else
    <div class="">Brak danych</div>
  @endif

</section>
@endsection
