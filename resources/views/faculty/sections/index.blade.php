@extends('faculty.layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Your Sections</h2>
   <a href="{{ route('faculty.sections.create') }}" class="btn btn-primary">Add Section</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Course</th>
         <th>Term</th>
         <th>Day</th>
         <th>Start Time</th>
         <th>End Time</th>
         <th>Room</th>
         <th>Capacity</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($sections as $section)
      <tr>
         <td>{{ $section->section_id }}</td>
         <td>{{ $section->course->course_name ?? 'N/A' }}</td>
         <td>{{ $section->term->term_name ?? 'N/A' }}</td>
         <td>{{ $section->schedule_day }}</td>
         <td>{{ $section->start_time }}</td>
         <td>{{ $section->end_time }}</td>
         <td>{{ $section->room->room_name ?? 'N/A' }}</td>
         <td>{{ $section->capacity }}</td>
         <td>
            <a href="{{ route('faculty.sections.edit', $section) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('faculty.sections.destroy', $section) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this section?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection