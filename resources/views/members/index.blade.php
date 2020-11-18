@extends('layouts.main')

@section('content')
<section class="member-section">
  <h2>
    Lista członków i rezydentów Koła Łowieckiego nr 87 Hubertus w Nowem na
    dzień 1-02-2020
  </h2>

  @if(Auth::check() && Auth::user()->name == 'admin')
    <a class="link" href="{{ route('czlonkowie_kola.create') }}">Dodaj członka</a>
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

</section>
@endsection
