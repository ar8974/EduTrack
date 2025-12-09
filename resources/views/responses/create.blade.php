@extends('layouts.app')
@section('content')
<h2>{{ isset($response) ? 'Edit Response' : 'Add Response' }}</h2>
<form action="{{ isset($response) ? route('responses.update', $response) : route('responses.store') }}" method="POST">
   @csrf
   @if(isset($response))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Question</label>
      <select name="question_id" class="form-control" required>
         <option value="">Select Question</option>
         @foreach($questions as $question)
         <option value="{{ $question->question_id }}" {{ (isset($response) && $response->question_id == $question->question_id) ? 'selected' : '' }}>
         {{ $question->question_text }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Student</label>
      <select name="student_id" class="form-control" required>
         <option value="">Select Student</option>
         @foreach($students as $student)
         <option value="{{ $student->user_id }}" {{ (isset($response) && $response->student_id == $student->user_id) ? 'selected' : '' }}>
         {{ $student->first_name }} {{ $student->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Selected Option (for MCQ)</label>
      <select name="selected_option_id" class="form-control">
         <option value="">Select Option</option>
         @foreach($options as $option)
         <option value="{{ $option->option_id }}" {{ (isset($response) && $response->selected_option_id == $option->option_id) ? 'selected' : '' }}>
         {{ $option->option_text }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Answer Text</label>
      <textarea name="answer_text" class="form-control">{{ $response->answer_text ?? old('answer_text') }}</textarea>
   </div>
   <div class="mb-3">
      <label>Score</label>
      <input type="number" step="0.01" name="score" class="form-control" value="{{ $response->score ?? old('score') }}">
   </div>
   <button class="btn btn-success">Save</button>
</form>
@endsection