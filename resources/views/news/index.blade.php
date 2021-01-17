@extends('layouts.main')

@section('content')
  <section class="news-section">

    <h2>Aktualności</h2>

    @if(Auth::check() && Auth::user()->name == 'admin')
      <a class="link" href="{{ route('aktualnosci.create') }}">Dodaj</a>
    @endif

    <x-alert msg="{{ Session::get('success') }}" />

    <br>

    @if( $news->count() > 0 )
      <ul class="news-list unorder-list-styles-reset">
        @foreach( $news as $new )
          <li class="news-list-item">
            <img class="news-img" src="{{ asset('storage/news').'/'.$new->image }}" alt="aktualność" />
            <div class="hes-gallery">
              <div class="news-description">{{ $new->description }}</div>
            </div>
            <div class="flex-row-center">
              @if(Auth::check() && Auth::user()->name == 'admin')
                <a href="{{ route('aktualnosci.edit', $new->id) }}">Edytuj</a>
                &nbsp; &nbsp; - &nbsp; &nbsp;
                <form action="{{ route('aktualnosci.destroy', $new->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="delete-btn">usuń</button>
                </form>
              @endif
            </div>
          </li>
          <br />
        @endforeach
      </ul>
    @else
      <div class="">Brak danych</div>
    @endif

  </section>
@endsection
