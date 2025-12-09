@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Enrollments</h2>
   <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Add Enrollment</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Student</th>
         <th>Section</th>
         <th>Course</th>
         <th>Enrolled On</th>
         <th>Final Grade</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @forelse($enrollments as $enrollment)
      <tr>
         <td>{{ $enrollment->enrollment_id }}</td>
         <td>{{ $enrollment->student->first_name ?? '' }} {{ $enrollment->student->last_name ?? '' }}</td>
         <td>{{ $enrollment->section->section_id ?? '' }}</td>
         <td>{{ $enrollment->section->course->course_code ?? '' }}</td>
         <td>{{ \Carbon\Carbon::parse($enrollment->enrolled_on)->format('d M Y') }}</td>
         <td>{{ $enrollment->final_grade }}</td>
         <td>
            <a href="{{ route('enrollments.edit', $enrollment->enrollment_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('enrollments.destroy', $enrollment->enrollment_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this enrollment?')">Delete</button>
            </form>
         </td>
      </tr>
      @empty
      <tr>
         <td colspan="7" class="text-center">No enrollments found</td>
      </tr>
      @endforelse
   </tbody>
</table>
@endsection