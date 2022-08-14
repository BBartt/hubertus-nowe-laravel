@extends('layouts.main')

@section('content')
<section class="home-section">
  <div>
    <img src="{{ asset('images/home/zdjecie czlonkow kola hubertus.jpg') }}" alt="zdjecie czlonkow kola" />
    <br />
    <em class="oath">
      "Przystępując do grona polskich myśliwych ślubuję uroczyście przestrzegać
      sumiennie praw łowieckich, postępować zgodnie z zasadami etyki łowieckiej,
      zachowywać tradycje polskiego łowiectwa, chronić przyrodę ojczystą, dbać o
      dobre imię łowiectwa i godność polskiego myśliwego."
    </em>
  </div>

  <section class="club-info">
    <h1 class="h1">Witamy na stronie internetowej Koła Łowieckiego "HUBERTUS" w Nowem</h1>
    <p class="paragraph">
      W dniu 9 lipca 1949r Koło przyjęło nazwę „Hubertus”, a w roku 1953
      nastąpiło połączenie kół łowieckich z Nowego i Warlubia, będącego
      pierwszym od 1945r prawnie zorganizowanym Kołem Łowieckim w powiecie
      świeckim. W wyniku tego połączenia, zwiększyła się powierzchnia terenów
      łowieckich, ponieważ doszły znaczne obszary leśne.
    </p>
    <p class="paragraph">
      Działalność członków naszego Koła została zauważona przez władze Polskiego
      Związku Łowieckiego i za osiągnięcia oraz włożony trud pracy dla dobra
      przyrody ojczystej Koło nasze otrzymało „Honorowy Żeton Zasługi”
      (określany jako „Złom") – jest to najwyższe odznaczenie łowieckie
      ustanowione 28 listopada 1929 roku uchwałą Wydziału Wykonawczego Polskiego
      Związku Stowarzyszeń Łowieckich.
    </p>
  </section>

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('main.create') }}" class="btn btn-link">Dodaj dane</a>
  @endif

  @if( $main->count() > 0 )
    <section class="info">
      @if( $main->count() > 0 )
        <ul class="main-list unorder-list-styles-reset">
          @foreach( $main as $mainItem )
            <li class="main-list-item flex-center-center">
              <div class="hes-gallery">
                <img class="main-img" src="{{ asset('storage/main_page').'/'.$mainItem->image }}" alt="informacja od administratora" />
              </div>
              <div class="main-name-surname">{{ $mainItem->description }}</div>
              @if(Auth::check() && Auth::user()->name == 'admin')
                <div class="flex-row-center">
                  <a href="{{ route('main.edit', $mainItem->id) }}">Edytuj</a>
                  <form action="{{ route('main.destroy', $mainItem->id) }}" method="POST">
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
        <div class="">else - usuń to</div>
      @endif
    </section>
  @endif

</section>
@endsection
