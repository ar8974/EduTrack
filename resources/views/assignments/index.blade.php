@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Assignments</h2>
   <a href="{{ route('assignments.create') }}" class="btn btn-primary">Add Assignment</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Section</th>
         <th>Title</th>
         <th>Description</th>
         <th>Due Date</th>
         <th>Total Points</th>
         <th>Team Based</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @forelse($assignments as $assignment)
      <tr>
         <td>{{ $assignment->assignment_id }}</td>
         <td>{{ $assignment->section->course->course_code ?? '' }} - {{ $assignment->section->section_id ?? '' }}</td>
         <td>{{ $assignment->title }}</td>
         <td>{{ Str::limit($assignment->description, 50) }}</td>
         <td>{{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y H:i') }}</td>
         <td>{{ $assignment->total_points }}</td>
         <td>{{ $assignment->is_team_based ? 'Yes' : 'No' }}</td>
         <td>
            <a href="{{ route('assignments.edit', $assignment->assignment_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('assignments.destroy', $assignment->assignment_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this assignment?')">Delete</button>
            </form>
         </td>
      </tr>
      @empty
      <tr>
         <td colspan="8" class="text-center">No assignments found</td>
      </tr>
      @endforelse
   </tbody>
</table>
@endsection