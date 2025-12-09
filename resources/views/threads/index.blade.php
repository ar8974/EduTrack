@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Discussion Threads</h2>
   <a href="{{ route('threads.create') }}" class="btn btn-primary">Add Thread</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Section</th>
         <th>Created By</th>
         <th>Title</th>
         <th>Created On</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($threads as $thread)
      <tr>
         <td>{{ $thread->thread_id }}</td>
         <td>{{ $thread->section->course->course_name ?? '' }} - {{ $thread->section->section_id ?? '' }}</td>
         <td>{{ $thread->creator->first_name ?? '' }} {{ $thread->creator->last_name ?? '' }}</td>
         <td>{{ $thread->title }}</td>
         <td>{{ \Carbon\Carbon::parse($thread->created_on)->format('d M Y H:i') }}</td>
         <td>
            <a href="{{ route('threads.edit', $thread->thread_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('threads.destroy', $thread->thread_id) }}" method="POST" style="display:inline-block;">
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