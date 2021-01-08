@extends('layouts.main')

@section('content')
<section class="address-section flex-column-center">

  @if($address)
    @if(Auth::check() && Auth::user()->name == 'admin')
      <a href="{{ route('adres.edit', 1) }}">Edytuj</a>
    @endif
    {!! nl2br(e($address->address)) !!}
  @else
    Brak danych
    @if(Auth::check() && Auth::user()->name == 'admin')
      <a href="{{ route('adres.create') }}">Dodaj</a>
    @endif
  @endif

</section>
@endsection
