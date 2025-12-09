@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Messages</h2>
   <a href="{{ route('messages.create') }}" class="btn btn-primary">Send Message</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Sender</th>
         <th>Receiver</th>
         <th>Subject</th>
         <th>Body</th>
         <th>Sent On</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($messages as $message)
      <tr>
         <td>{{ $message->message_id }}</td>
         <td>{{ $message->sender->first_name ?? '' }} {{ $message->sender->last_name ?? '' }}</td>
         <td>{{ $message->receiver->first_name ?? '' }} {{ $message->receiver->last_name ?? '' }}</td>
         <td>{{ $message->subject }}</td>
         <td>{{ \Illuminate\Support\Str::limit($message->body, 50) }}</td>
         <td>{{ \Carbon\Carbon::parse($message->sent_on)->format('d M Y H:i') }}</td>
         <td>
            <form action="{{ route('messages.destroy', $message->message_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this message?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection