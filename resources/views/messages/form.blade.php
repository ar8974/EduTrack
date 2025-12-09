@extends('layouts.app')
@section('content')
<h2>{{ isset($message) ? 'Edit Message' : 'Send Message' }}</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ isset($message) ? route('messages.update', $message->message_id) : route('messages.store') }}" method="POST">
   @csrf
   @if(isset($message))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Sender</label>
      <select name="sender_id" class="form-control" required>
         <option value="">Select Sender</option>
         @foreach($users as $user)
         <option value="{{ $user->user_id }}" {{ (isset($message) && $message->sender_id == $user->user_id) ? 'selected' : '' }}>
         {{ $user->first_name }} {{ $user->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Receiver</label>
      <select name="receiver_id" class="form-control" required>
         <option value="">Select Receiver</option>
         @foreach($users as $user)
         <option value="{{ $user->user_id }}" {{ (isset($message) && $message->receiver_id == $user->user_id) ? 'selected' : '' }}>
         {{ $user->first_name }} {{ $user->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Subject</label>
      <input type="text" name="subject" class="form-control" value="{{ $message->subject ?? old('subject') }}" required>
   </div>
   <div class="mb-3">
      <label>Body</label>
      <textarea name="body" class="form-control" required>{{ $message->body ?? old('body') }}</textarea>
   </div>
   <button class="btn btn-success">{{ isset($message) ? 'Update' : 'Send' }}</button>
</form>
@endsection