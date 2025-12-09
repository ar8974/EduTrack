@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Discussion Threads</h2>
   <a href="{{ route('threads.create') }}" class="btn btn-primary">Create Thread</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Section</th>
         <th>Title</th>
         <th>Created By</th>
         <th>Created On</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($threads as $thread)
      <tr>
         <td>{{ $thread->thread_id }}</td>
         <td>{{ $thread->section->course->course_name ?? '' }}</td>
         <td>{{ $thread->title }}</td>
         <td>{{ $thread->creator->first_name ?? '' }} {{ $thread->creator->last_name ?? '' }}</td>
         <td>{{ $thread->created_on }}</td>
         <td>
            <a href="{{ route('threads.show', $thread) }}" class="btn btn-sm btn-info">View Posts</a>
            <a href="{{ route('threads.edit', $thread) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('threads.destroy', $thread) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this thread?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection