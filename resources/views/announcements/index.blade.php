@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Announcements</h2>
   <a href="{{ route('announcements.create') }}" class="btn btn-primary">Add Announcement</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Section</th>
         <th>Posted By</th>
         <th>Title</th>
         <th>Message</th>
         <th>Posted On</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($announcements as $announcement)
      <tr>
         <td>{{ $announcement->announcement_id }}</td>
         <td>{{ $announcement->section->section_id ?? '' }}</td>
         <td>{{ $announcement->user->first_name ?? '' }} {{ $announcement->user->last_name ?? '' }}</td>
         <td>{{ $announcement->title }}</td>
         <td>{{ \Illuminate\Support\Str::limit($announcement->message, 50) }}</td>
         <td>{{ \Carbon\Carbon::parse($announcement->posted_on)->format('d M Y H:i') }}</td>
         <td>
            <a href="{{ route('announcements.edit', $announcement->announcement_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('announcements.destroy', $announcement->announcement_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this announcement?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection