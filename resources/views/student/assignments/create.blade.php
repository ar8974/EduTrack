@extends('student.layouts.app')
@section('content')
<div class="container mt-4">
   <h2>Submit Assignment</h2>
   <div class="card shadow-sm p-4">
      <h5>{{ $assignment->title }}</h5>
      <p class="text-muted">
         {{ $assignment->section->course->course_name }}
      </p>
      <p><strong>Due:</strong>
         {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y h:i A') }}
      </p>
      <form action="{{ route('student.assignments.store', $assignment->assignment_id) }}"
         method="POST" enctype="multipart/form-data">
         @csrf
         <div class="mb-3">
            <label class="form-label">Upload File</label>
            <input type="file" name="file" class="form-control" required>
            @error('file')
            <span class="text-danger small">{{ $message }}</span>
            @enderror
         </div>
         <button class="btn btn-success">Submit Assignment</button>
      </form>
   </div>
</div>
@endsection