@extends('student.layouts.app')
@section('content')
<div class="container mt-4">
   <h2>Your Messages</h2>
   <a href="{{ route('student.messages.create') }}" class="btn btn-primary mb-3">
   New Message
   </a>
   <div class="card shadow-sm p-3">
      <table class="table table-bordered">
         <thead>
            <tr>
               <th>Subject</th>
               <th>From</th>
               <th>To</th>
               <th>Sent</th>
            </tr>
         </thead>
         <tbody>
            @forelse ($messages as $m)
            <tr>
               <td>{{ $m->subject }}</td>
               <td>{{ $m->sender->first_name }} {{ $m->sender->last_name }}</td>
               <td>{{ $m->receiver->first_name }} {{ $m->receiver->last_name }}</td>
               <td>{{ \Carbon\Carbon::parse($m->sent_on)->format('d M Y h:i A') }}</td>
            </tr>
            @empty
            <tr>
               <td colspan="4" class="text-center">No messages found.</td>
            </tr>
            @endforelse
         </tbody>
      </table>
   </div>
</div>
@endsection