@extends('layouts.main')

@section('content')
  <div class="messages-section index">

    <h1>Komunikaty</h1>

    @if(Auth::check() && Auth::user()->name == 'admin')
      <a href="{{ route('komunikaty.create') }}">Dodaj komunikat</a>
    @endif

    @if( count($messages) > 0 )
      <div class="messages-wrapper">
        @foreach( $messages as $message )
          <div class="message flex-row-center">
            <a href="{{ route('komunikaty.show', ['komunikaty' => $message->id]) }}">
              <h1>{{ $message->title }}</h1>
            </a>
            <span>{{ date($message->created_at) }}</span>
            @if(Auth::check() && Auth::user()->name == 'admin')
              <div class="actions flex-row-center">
                <a href="{{ route('komunikaty.edit', $message->id) }}">Edytuj</a>
                <form action="{{ route('komunikaty.destroy', $message->id) }}" method="POST">
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
      <h1 class="padding">Brak komunikatów</h1>
    @endif
  </div>
@endsection
