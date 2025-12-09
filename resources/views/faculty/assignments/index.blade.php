@extends('faculty.layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Assignments</h2>
   <a href="{{ route('faculty.assignments.create') }}" class="btn btn-primary">Add Assignment</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Title</th>
         <th>Description</th>
         <th>Section</th>
         <th>Due Date</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($assignments as $assignment)
      <tr>
         <td>{{ $assignment->assignment_id }}</td>
         <td>{{ $assignment->title }}</td>
         <td>{{ $assignment->description }}</td>
         <td>{{ $assignment->section_id }}</td>
         <td>{{ $assignment->due_date }}</td>
         <td>
            <a href="{{ route('faculty.assignments.edit', $assignment) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('faculty.assignments.destroy', $assignment) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this assignment?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection