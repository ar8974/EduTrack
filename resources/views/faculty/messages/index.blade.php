@extends('faculty.layouts.app')
@section('content')
<div class="container mt-3">
   <h2>Messages</h2>
   <a href="{{ route('faculty.messages.create') }}" class="btn btn-primary mb-3">
   Send New Message
   </a>
   @if(session('success'))
   <div class="alert alert-success">{{ session('success') }}</div>
   @endif
   <table class="table table-bordered">
      <thead>
         <tr>
            <th>From</th>
            <th>To</th>
            <th>Subject</th>
            <th>Sent On</th>
         </tr>
      </thead>
      <tbody>
         @foreach($messages as $m)
         <tr>
            <td>{{ $m->sender->first_name }} {{ $m->sender->last_name }}</td>
            <td>{{ $m->receiver->first_name }} {{ $m->receiver->last_name }}</td>
            <td>{{ $m->subject }}</td>
            <td>{{ $m->sent_on }}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@endsection