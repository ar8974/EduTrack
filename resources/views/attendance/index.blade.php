@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Attendance</h2>
   <a href="{{ route('attendance.create') }}" class="btn btn-primary">Mark Attendance</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Section</th>
         <th>Student</th>
         <th>Date</th>
         <th>Status</th>
         <th>Marked By</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($attendances as $attendance)
      <tr>
         <td>{{ $attendance->attendance_id }}</td>
         <td>{{ $attendance->section->course->course_name ?? '' }}</td>
         <td>{{ $attendance->student->first_name ?? '' }} {{ $attendance->student->last_name ?? '' }}</td>
         <td>{{ $attendance->attendance_date }}</td>
         <td>{{ $attendance->status }}</td>
         <td>{{ $attendance->markedBy->first_name ?? '' }} {{ $attendance->markedBy->last_name ?? '' }}</td>
         <td>
            <a href="{{ route('attendance.edit', $attendance) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('attendance.destroy', $attendance) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this record?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection