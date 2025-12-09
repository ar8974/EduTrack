@extends('layouts.app')
@section('content')
<h2>Message Details</h2>
<div class="card mb-3">
   <div class="card-body">
      <h5>Subject: {{ $message->subject }}</h5>
      <p><strong>From:</strong> {{ $message->sender->first_name ?? '' }} {{ $message->sender->last_name ?? '' }}</p>
      <p><strong>To:</strong> {{ $message->receiver->first_name ?? '' }} {{ $message->receiver->last_name ?? '' }}</p>
      <p><strong>Sent On:</strong> {{ $message->sent_on }}</p>
      <hr>
      <p>{{ $message->body }}</p>
   </div>
</div>
<a href="{{ route('messages.index') }}" class="btn btn-secondary">Back</a>
@endsection