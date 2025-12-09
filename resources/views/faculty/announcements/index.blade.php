@extends('faculty.layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Announcements</h2>
   <a href="{{ route('faculty.announcements.create') }}" class="btn btn-primary">Add Announcement</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Section</th>
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
         <td>{{ $announcement->section_id }}</td>
         <td>{{ $announcement->title }}</td>
         <td>{{ $announcement->message }}</td>
         <td>{{ $announcement->posted_on }}</td>
         <td>
            <a href="{{ route('faculty.announcements.edit', $announcement) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('faculty.announcements.destroy', $announcement) }}" method="POST" style="display:inline-block;">
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