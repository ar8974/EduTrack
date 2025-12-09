@extends('layouts.app')
@section('content')
<h2>Posts in: {{ $thread->title }}</h2>
<a href="{{ route('posts.create', $thread) }}" class="btn btn-primary mb-3">Add Post</a>
@foreach($posts as $post)
<div class="card mb-2">
   <div class="card-body">
      <p>{{ $post->message }}</p>
      <small>By: {{ $post->user->first_name ?? '' }} {{ $post->user->last_name ?? '' }} | {{ $post->posted_on }}</small>
   </div>
</div>
@endforeach
<a href="{{ route('threads.index') }}" class="btn btn-secondary mt-3">Back to Threads</a>
@endsection