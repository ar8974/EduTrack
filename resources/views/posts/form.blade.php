@extends('layouts.app')
@section('content')
<h2>{{ isset($post) ? 'Edit Post' : 'Add Post' }}</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ isset($post) ? route('posts.update', $post->post_id) : route('posts.store') }}" method="POST">
   @csrf
   @if(isset($post))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Thread</label>
      <select name="thread_id" class="form-control" required>
         <option value="">Select Thread</option>
         @foreach($threads as $thread)
         <option value="{{ $thread->thread_id }}" {{ (isset($post) && $post->thread_id == $thread->thread_id) ? 'selected' : '' }}>
         {{ $thread->title }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>User</label>
      <select name="user_id" class="form-control" required>
         <option value="">Select User</option>
         @foreach($users as $user)
         <option value="{{ $user->user_id }}" {{ (isset($post) && $post->user_id == $user->user_id) ? 'selected' : '' }}>
         {{ $user->first_name }} {{ $user->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Message</label>
      <textarea name="message" class="form-control" required>{{ $post->message ?? old('message') }}</textarea>
   </div>
   <button class="btn btn-success">{{ isset($post) ? 'Update' : 'Create' }}</button>
</form>
@endsection