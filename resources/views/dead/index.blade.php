@extends('layouts.main')

@section('content')
<section class="dead-section">

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a class="link" href="{{ route('kraina.create') }}">Dodaj osobę</a>
  @endif

  <x-alert msg="{{ Session::get('success') }}" />

  <br />

  <table class="table">
    <thead>
      <tr>
        <td></td>
        <td>Imię i nazwisko:</td>
      </tr>
    </thead>
    <tbody>
      @if( $deads->count() > 0 )
        @foreach($deads as $dead)
          <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$dead->name}}</td>
            @if(Auth::check() && Auth::user()->name == 'admin')
              <td>
                <a href="{{ route('kraina.edit', $dead->id)}}">Edytuj</a>
                <form action="{{ route('kraina.destroy', $dead->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn delete-btn" type="submit">Usuń</button>
                </form>
              </td>
            @endif
          </tr>
        @endforeach
      @else
        <tr>
          <td></td>
          <td>Brak danych</td>
        </tr>
      @endif
    </tbody>
  </table>

</section>
@endsection
