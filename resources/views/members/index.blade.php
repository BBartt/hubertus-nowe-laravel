@extends('layouts.main')

@section('content')
<section class="member-section">

  @if(isset($titles->title1))
    <h2>{{ $titles->title1 }}</h2>
  @endif


  @if(Auth::check() && Auth::user()->name == 'admin')
    <a class="link" href="{{ route('czlonkowie_kola.create') }}">Dodaj członka</a>
    <br>
    <a class="link" href="{{ route('rezydenci.create') }}">Dodaj rezydenta</a>
    <br>

    @if($titles)
      <a class="link" href="{{ route('membersTitles.edit', 1) }}">Edytuj tytuły</a>
    @else
      <a class="link" href="{{ route('membersTitles.create') }}">Dodaj tytuły</a>
    @endif

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
      @if( $members->count() > 0 )
        @foreach($members as $member)
          <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$member->name}}</td>
            @if(Auth::check() && Auth::user()->name == 'admin')
              <td>
                <a href="{{ route('czlonkowie_kola.edit', $member->id)}}">Edytuj</a>
                <form action="{{ route('czlonkowie_kola.destroy', $member->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn delete-btn" type="submit">Usuń</button>
                </form>
              </td>
            @endif
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>

  @if(isset($titles->title1))
    <h2>{{ $titles->title2 }}</h2>
  @endif

  <table class="table">
    <thead>
      <tr>
        <td></td>
        <td>Imię i nazwisko:</td>
      </tr>
    </thead>
    <tbody>
      @if( $residents->count() > 0 )
        @foreach($residents as $resident)
          <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$resident->name}}</td>
            @if(Auth::check() && Auth::user()->name == 'admin')
              <td>
                <a href="{{ route('rezydenci.edit', $resident->id)}}">Edytuj</a>
                <form action="{{ route('rezydenci.destroy', $resident->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn delete-btn" type="submit">Usuń</button>
                </form>
              </td>
            @endif
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>

</section>
@endsection
