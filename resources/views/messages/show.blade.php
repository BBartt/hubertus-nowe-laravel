@extends('layouts.main')

@section('content')
  <div class="messages-section show">

    <h1 class="title">{{ $komunikaty->title }}</h1>

    @if($komunikaty->image)
      <img
        class="message-img"
        src="{{ asset('storage/messages').'/'.$komunikaty->image }}"
        alt="{{ $komunikaty->title }}"
      />
    @endif

    <p>{!! nl2br(e($komunikaty->description)) !!}</p>

    @if($komunikaty->link)
      <a target="_blank" href="{{ $komunikaty->link }}">{{ $komunikaty->linkName ?: "Link" }}</a>
    @endif

  </div>
@endsection
