@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Discussion Posts</h2>
   <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Thread</th>
         <th>User</th>
         <th>Message</th>
         <th>Posted On</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($posts as $post)
      <tr>
         <td>{{ $post->post_id }}</td>
         <td>{{ $post->thread->title ?? '' }}</td>
         <td>{{ $post->user->first_name ?? '' }} {{ $post->user->last_name ?? '' }}</td>
         <td>{{ \Illuminate\Support\Str::limit($post->message, 50) }}</td>
         <td>{{ \Carbon\Carbon::parse($post->posted_on)->format('d M Y H:i') }}</td>
         <td>
            <a href="{{ route('posts.edit', $post->post_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('posts.destroy', $post->post_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this post?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection