@extends('layouts.main')

@section('content')
<div class="venison-section flex-column">
  @if(Auth::check() && Auth::user()->name == 'admin')
    <a href="{{ route('dziczyzna.create') }}">Dodaj produkt</a>
  @endif

  <h2 class="color-blue">Zdrowa dziczyzna na twoim stole</h2>

  <div class="wrapper flex-column">
    <h1 class="color-purple">BEZPOŚREDNIA</h1>
    <h1 class="color-purple">SPRZEDAŻ</h1>
    <h1 class="color-purple">DZICZYZNY</h1>
  </div>

  <h1 class="color-white border-bottom">CENNIK</h1>

  <p>
    DZICZYZNA PROSTO OD MYŚLIWEGO <br>
    W BARDZO DOBREJ CENIE
  </p>
  <p>Zwierzyna patroszona w skórze</p>

  <x-alert msg="{{ Session::get('success') }}" />

  @if( count($venisons) > 0 )
    <div class="venisons-wrapper flex-row-center">
      @foreach( $venisons as $venison )
        <div>
          <a
           class="venison flex-column"
           href="mailto:kl87@pzlbydgoszcz.pl?subject=Zamówienie"
           >
            <div class="content">
              <img
                class="venison-img"
                src="{{ asset('storage/venison').'/'.$venison->image }}"
                alt="{{ $venison->name }}"
              />
              <div>
                <h1>{{ $venison->name }}</h1>
                <div class="info">
                  <div>Zamówienia:</div>
                  <div>{{ $venison->interval }}</div>
                  <div class="price">{{ $venison->price }}</div>
                </div>
              </div>
            </div>
          </a>
          @if(Auth::check() && Auth::user()->name == 'admin')
            <div class="actions flex-row-center">
              <a href="{{ route('dziczyzna.edit', $venison->id) }}">Edytuj</a>
              <form action="{{ route('dziczyzna.destroy', $venison->id) }}" method="POST">
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
    <h1 class="padding-50-0 border-white">Brak produktów</h1>
  @endif

  <h1 class="border-bottom color-white">SPRZEDAJEMY WYŁĄCZNIE CAŁE TUSZE</h1>

  <div class="contact padding-50-0">
    <h1>ZAMÓW JUŻ TERAZ</h1>
    <a href="tel:+48 601 410 033">+48 601 410 033</a> <br>
    <a href="tel:+48 662 300 147">+48 662 300 147</a> <br>
    <a href="mailto:kl87@pzlbydgoszcz.pl">kl87@pzlbydgoszcz.pl</a>
  </div>

  <h1>
    Koło Łowieckie 87 <br>
    „HUBERTUS” <br>
    w Nowem <br>
    <address>86-170 Nowe nad Wisłą</address>
  </h1>

</div>
@endsection
