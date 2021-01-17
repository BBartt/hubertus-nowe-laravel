@extends('layouts.main')

@section('content')
  <section class="party-section index">

    <h2>
      Jako Koło Łowieckie Hubertus 87 w Nowem, <br />
      wspieramy imprezę:
    </h2>

    @if(Auth::check() && Auth::user()->name == 'admin')
      <a class="link" href="{{ route('imprezy.create') }}">Dodaj dane</a>
    @endif

    <x-alert msg="{{ Session::get('success') }}" />

    <br>

    @if( $parties->count() > 0 )
      <ul class="party-list unorder-list-styles-reset">
        @foreach( $parties as $party )
          <li class="parties-list-item flex-column-center">

            <p class="description">{!! nl2br(e($party->description)) !!}</p>

            @if($party->link_1)
              <a target="_blank" href="{{ $party->link_1 }}">{{ $party->link_1 }}</a>
            @endif
            @if($party->link_2)
              <a target="_blank" href="{{ $party->link_2 }}">{{ $party->link_2 }}</a>
            @endif
            @if($party->link_3)
              <a target="_blank" href="{{ $party->link_3 }}">{{ $party->link_3 }}</a>
            @endif
            @if($party->link_4)
              <a target="_blank" href="{{ $party->link_4 }}">{{ $party->link_4 }}</a>
            @endif
            @if($party->link_5)
              <a target="_blank" href="{{ $party->link_5 }}">{{ $party->link_5 }}</a>
            @endif

            @if(count($party->partyImages) > 0)
              <div class="hes-gallery images-wrapper flex-row-center">
                @foreach( $party->partyImages as $image )
                  <div>
                    <img
                      class="party-image"
                      src="{{ asset('storage/party__images-').$image->party_id."/".$image->image }}"
                    />
                    @if(Auth::check() && Auth::user()->name == 'admin')
                    <br />
                    <div class="flex-row-center">
                      <a href="{{ route('imprezy_zdjecia.edit', $image->id) }}">Edytuj zdjęcie</a>
                      &nbsp; &nbsp; - &nbsp; &nbsp;
                      <form action="{{ route('imprezy_zdjecia.destroy', $image->id) }}" method="POST">
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

            @if(Auth::check() && Auth::user()->name == 'admin')
              <br />
              <div class="flex-row-center">
                <a href="{{ route('imprezy.edit', $party->id) }}">Edytuj tekst</a>
                &nbsp; &nbsp; - &nbsp; &nbsp;
                <a href="{{ route('imprezy_zdjecia.create', $party->id) }}">Dodaj zdjęcia</a>
                &nbsp; &nbsp; - &nbsp; &nbsp;
                <form action="{{ route('imprezy.destroy', $party->id) }}" method="POST">
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
