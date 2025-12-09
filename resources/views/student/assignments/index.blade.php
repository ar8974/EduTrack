@extends('student.layouts.app')
@section('content')
<div class="container mt-4">
   <h2>Your Assignments</h2>
   <table class="table table-striped table-bordered mt-3">
      <thead class="table-dark">
         <tr>
            <th>Assignment</th>
            <th>Course</th>
            <th>Due Date</th>
            <th>Points</th>
            <th>Submit</th>
         </tr>
      </thead>
      <tbody>
         @forelse($assignments as $a)
         <tr>
            <td>{{ $a->title }}</td>
            <td>{{ $a->section->course->course_name }}</td>
            <td>{{ \Carbon\Carbon::parse($a->due_date)->format('d M Y h:i A') }}</td>
            <td>{{ $a->total_points }}</td>
            <td>
               <a href="{{ route('student.assignments.create', $a->assignment_id) }}"
                  class="btn btn-primary btn-sm">
               Submit
               </a>
            </td>
         </tr>
         @empty
         <tr>
            <td colspan="5" class="text-center text-muted">No assignments found.</td>
         </tr>
         @endforelse
      </tbody>
   </table>
</div>
@endsection