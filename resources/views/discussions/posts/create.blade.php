@extends('layouts.app')
@section('content')
<h2>{{ isset($post) ? 'Edit Post' : 'Add Post' }}</h2>
<form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="POST">
   @csrf
   @if(isset($post))
   @method('PUT')
   @endif
   <input type="hidden" name="thread_id" value="{{ $thread->thread_id }}">
   <div class="mb-3">
      <label>Message</label>
      <textarea name="message" class="form-control" required>{{ $post->message ?? old('message') }}</textarea>
   </div>
   <button class="btn btn-success">Save</button>
</form>
@endsection