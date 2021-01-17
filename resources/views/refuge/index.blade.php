@extends('layouts.main')

@section('content')
  <section class="refuge-section index">

    <h2>Ostoja</h2>

    @if(Auth::check() && Auth::user()->name == 'admin')
      <a class="link" href="{{ route('ostoja.create') }}">Dodaj dane</a>
    @endif

    <x-alert msg="{{ Session::get('success') }}" />

    <br>

    @if( $refuges->count() > 0 )
      <ul class="refuge-list unorder-list-styles-reset">
        @foreach( $refuges as $refuge )
          <li class="refuges-list-item flex-column-center">

            @if(count($refuge->refugeImage) > 0)
              <div class="hes-gallery images-wrapper flex-row-center">
                @foreach( $refuge->refugeImage as $image )
                  <div>
                    <img
                      class="refuge-image"
                      src="{{ asset('storage/refuges__images-').$image->refuge_id."/".$image->image }}"
                    />
                    @if(Auth::check() && Auth::user()->name == 'admin')
                      <br />
                      <div class="flex-row-center">
                        <a href="{{ route('ostoja_zdjecia.edit', $image->id) }}">Edytuj zdjęcie</a>
                        &nbsp; &nbsp; - &nbsp; &nbsp;
                        <form action="{{ route('ostoja_zdjecia.destroy', $image->id) }}" method="POST">
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

            <p class="description">{!! nl2br(e($refuge->description)) !!}</p>

            @if(Auth::check() && Auth::user()->name == 'admin')
              <br />
              <div class="flex-row-center">
                <a href="{{ route('ostoja.edit', $refuge->id) }}">Edytuj tekst</a>
                &nbsp; &nbsp; - &nbsp; &nbsp;
                <a href="{{ route('ostoja_zdjecia.create', $refuge->id) }}">Dodaj zdjęcia</a>
                &nbsp; &nbsp; - &nbsp; &nbsp;
                <form action="{{ route('ostoja.destroy', $refuge->id) }}" method="POST">
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
