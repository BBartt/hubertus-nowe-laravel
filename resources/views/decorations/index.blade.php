@extends('layouts.main')

@section('content')
<section class="decorations-section index">

  <h3>
    Koło Łowieckie Nr 87 Hubertus w Nowem za zasługi dla łowiectwa
    zostało odznaczone Złotym Medalem Zasługi Łowieckiej w 1996 roku i
    najwyższym odznaczeniem łowieckim, tj. "Złomem" w 2016 roku).
  </h3>

  <div class="hes-gallery">
    <img src="{{ asset('images/decorations/sztandar 1.jpg') }}" alt="" />
    <img src="{{ asset('images/decorations/sztandar 2.jpg') }}" alt="" />
  </div>

  <h3>
    Ponadto na podstawie uchwał Walnych Zgromadzeń członków Koła i
    wniosków opracowywanych przez Zarządu Koła odznaczeniami łowieckimi
    zostali uhonorowani:
  </h3>



  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('odznaczenia.create') }}">Dodaj dane</a>
    <br>
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
