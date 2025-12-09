@extends('student.layouts.app')
@section('content')
<div class="container mt-4">
   <h2>Submission Details</h2>
   <div class="card p-4 shadow-sm">
      <h5>{{ $submission->assignment->title }}</h5>
      <p class="text-muted">
         {{ $submission->assignment->section->course->course_name }}
      </p>
      <p><strong>Submitted:</strong> 
         {{ \Carbon\Carbon::parse($submission->submitted_on)->format('d M Y h:i A') }}
      </p>
      <p><strong>Grade:</strong> {{ $submission->grade ?? 'Not graded' }}</p>
      <p><strong>Feedback:</strong> {{ $submission->feedback ?? 'No feedback yet.' }}</p>
      <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank"
         class="btn btn-outline-primary mt-3">
      Download Submitted File
      </a>
   </div>
</div>
@endsection