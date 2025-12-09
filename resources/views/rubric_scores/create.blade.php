@extends('layouts.app')
@section('content')
<h2>{{ isset($rubricScore) ? 'Edit Rubric Score' : 'Add Rubric Score' }}</h2>
<form action="{{ isset($rubricScore) ? route('rubric_scores.update', $rubricScore) : route('rubric_scores.store') }}" method="POST">
   @csrf
   @if(isset($rubricScore))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Rubric</label>
      <select name="rubric_id" class="form-control" required>
         <option value="">Select Rubric</option>
         @foreach($rubrics as $rubric)
         <option value="{{ $rubric->rubric_id }}" {{ (isset($rubricScore) && $rubricScore->rubric_id == $rubric->rubric_id) ? 'selected' : '' }}>
         {{ $rubric->criterion }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Submission</label>
      <select name="submission_id" class="form-control" required>
         <option value="">Select Submission</option>
         @foreach($submissions as $submission)
         <option value="{{ $submission->submission_id }}" {{ (isset($rubricScore) && $rubricScore->submission_id == $submission->submission_id) ? 'selected' : '' }}>
         {{ $submission->assignment->title ?? '' }} ({{ $submission->student->first_name ?? '' }})
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Score</label>
      <input type="number" step="0.01" name="score" class="form-control" value="{{ $rubricScore->score ?? old('score') }}" required>
   </div>
   <div class="mb-3">
      <label>Comments</label>
      <textarea name="comments" class="form-control">{{ $rubricScore->comments ?? old('comments') }}</textarea>
   </div>
   <button class="btn btn-success">Save</button>
</form>
@endsection