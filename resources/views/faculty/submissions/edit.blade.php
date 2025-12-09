@extends('faculty.layouts.app')
@section('content')
<div class="card">
   <div class="card-header">
      Grade Submission #{{ $submission->submission_id }}
   </div>
   <div class="card-body">
      <p><strong>Assignment:</strong> {{ $submission->assignment->title ?? 'N/A' }}</p>
      <p><strong>Student:</strong> {{ $submission->student->first_name ?? '' }} {{ $submission->student->last_name ?? '' }}</p>
      <p><strong>Submitted On:</strong> {{ $submission->submitted_on }}</p>
      @if($submission->file_path)
      <p><a href="{{ asset($submission->file_path) }}" target="_blank">Download Submission</a></p>
      @endif
      <form method="POST" action="{{ route('faculty.submissions.update', $submission) }}">
         @csrf
         @method('PUT')
         <div class="mb-3">
            <label class="form-label">Grade</label>
            <input type="number" name="grade" class="form-control" value="{{ $submission->grade }}" required>
         </div>
         <div class="mb-3">
            <label class="form-label">Feedback</label>
            <textarea name="feedback" class="form-control">{{ $submission->feedback }}</textarea>
         </div>
         <button class="btn btn-success">Submit Grade</button>
      </form>
   </div>
</div>
@endsection