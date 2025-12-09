@extends('layouts.app')
@section('content')
<h2>{{ isset($submission) ? 'Edit Submission' : 'Add Submission' }}</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ isset($submission) ? route('submissions.update', $submission->submission_id) : route('submissions.store') }}" method="POST">
   @csrf
   @if(isset($submission))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Assignment</label>
      <select name="assignment_id" class="form-control" required>
         <option value="">Select Assignment</option>
         @foreach($assignments as $assignment)
         <option value="{{ $assignment->assignment_id }}" {{ (isset($submission) && $submission->assignment_id == $assignment->assignment_id) ? 'selected' : '' }}>
         {{ $assignment->title }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Student</label>
      <select name="student_id" class="form-control" required>
         <option value="">Select Student</option>
         @foreach($students as $student)
         <option value="{{ $student->user_id }}" {{ (isset($submission) && $submission->student_id == $student->user_id) ? 'selected' : '' }}>
         {{ $student->first_name }} {{ $student->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Submitted On</label>
      <input type="datetime-local" name="submitted_on" class="form-control" value="{{ isset($submission) ? \Carbon\Carbon::parse($submission->submitted_on)->format('Y-m-d\TH:i') : old('submitted_on') }}">
   </div>
   <div class="mb-3">
      <label>File Path</label>
      <input type="text" name="file_path" class="form-control" value="{{ $submission->file_path ?? old('file_path') }}">
   </div>
   <div class="mb-3">
      <label>Grade</label>
      <input type="number" step="0.01" name="grade" class="form-control" value="{{ $submission->grade ?? old('grade') }}">
   </div>
   <div class="mb-3">
      <label>Feedback</label>
      <textarea name="feedback" class="form-control">{{ $submission->feedback ?? old('feedback') }}</textarea>
   </div>
   <div class="mb-3">
      <label>Graded By</label>
      <select name="graded_by" class="form-control">
         <option value="">Select Grader</option>
         @foreach($graders as $grader)
         <option value="{{ $grader->user_id }}" {{ (isset($submission) && $submission->graded_by == $grader->user_id) ? 'selected' : '' }}>
         {{ $grader->first_name }} {{ $grader->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <button class="btn btn-success">{{ isset($submission) ? 'Update' : 'Create' }}</button>
</form>
@endsection