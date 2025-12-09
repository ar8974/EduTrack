@extends('student.layouts.app')
@section('content')
<div class="container mt-4">
   <h2>Submit Assignment</h2>
   <div class="card shadow-sm p-4">
      <h5>{{ $assignment->title }}</h5>
      <p><strong>Course:</strong> {{ $assignment->section->course->course_code }} - {{ $assignment->section->course->course_name }}</p>
      <p><strong>Due:</strong> {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') }}</p>
      <form action="{{ route('student.submissions.store') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="assignment_id" value="{{ $assignment->assignment_id }}">
         <div class="mb-3">
            <label for="file" class="form-label">Select file to upload</label>
            <input type="file" name="file" class="form-control" required>
            @error('file')
            <small class="text-danger">{{ $message }}</small>
            @enderror
         </div>
         <button class="btn btn-primary">Submit Assignment</button>
      </form>
   </div>
</div>
@endsection