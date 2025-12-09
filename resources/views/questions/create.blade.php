@extends('layouts.app')
@section('content')
<h2>{{ isset($question) ? 'Edit Question' : 'Add Question' }}</h2>
<form action="{{ isset($question) ? route('questions.update', $question) : route('questions.store') }}" method="POST">
   @csrf
   @if(isset($question))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Exam</label>
      <select name="exam_id" class="form-control" required>
         <option value="">Select Exam</option>
         @foreach($exams as $exam)
         <option value="{{ $exam->exam_id }}" {{ (isset($question) && $question->exam_id == $exam->exam_id) ? 'selected' : '' }}>
         {{ $exam->title }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Question Text</label>
      <textarea name="question_text" class="form-control" required>{{ $question->question_text ?? old('question_text') }}</textarea>
   </div>
   <div class="mb-3">
      <label>Question Type</label>
      <select name="question_type" class="form-control" required>
         <option value="">Select Type</option>
         <option value="MCQ" {{ (isset($question) && $question->question_type == 'MCQ') ? 'selected' : '' }}>MCQ</option>
         <option value="Short Answer" {{ (isset($question) && $question->question_type == 'Short Answer') ? 'selected' : '' }}>Short Answer</option>
         <option value="Coding" {{ (isset($question) && $question->question_type == 'Coding') ? 'selected' : '' }}>Coding</option>
      </select>
   </div>
   <div class="mb-3">
      <label>Points</label>
      <input type="number" step="0.01" name="points" class="form-control" value="{{ $question->points ?? old('points') }}" required>
   </div>
   <button class="btn btn-success">Save</button>
</form>
@endsection