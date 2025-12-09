@extends('student.layouts.app')
@section('content')
<div class="container mt-4">
   <h2>Your Submissions</h2>
   <table class="table table-bordered">
      <thead>
         <tr>
            <th>Assignment</th>
            <th>Course</th>
            <th>Submitted On</th>
            <th>Grade</th>
            <th>Feedback</th>
            <th>File</th>
         </tr>
      </thead>
      <tbody>
         @forelse($submissions as $submission)
         @php
         $assignment = $submission->assignment;
         $courseName = optional($assignment->section->course)->course_name;
         @endphp
         <tr>
            <td>{{ $assignment->title ?? 'N/A' }}</td>
            <td>{{ $courseName ?? 'N/A' }}</td>
            <td>{{ \Carbon\Carbon::parse($submission->submitted_on)->format('d M Y h:i A') }}</td>
            <td>{{ $submission->grade ?? 'Not graded' }}</td>
            <td>{{ $submission->feedback ?? 'No feedback' }}</td>
            <td>
               @if($submission->file_path)
               <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
               Download
               </a>
               @else
               N/A
               @endif
            </td>
         </tr>
         @empty
         <tr>
            <td colspan="6" class="text-center">No submissions found.</td>
         </tr>
         @endforelse
      </tbody>
   </table>
</div>
@endsection