@extends('layouts.app')
@section('content')
<h2>{{ isset($question) ? 'Edit Question' : 'Add Security Question' }}</h2>
<form action="{{ isset($question) ? route('security_questions.update', $question) : route('security_questions.store') }}" method="POST">
   @csrf
   @if(isset($question))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Question Text</label>
      <input type="text" name="question_text" class="form-control" value="{{ $question->question_text ?? old('question_text') }}" required>
   </div>
   <button class="btn btn-success">Save</button>
</form>
@endsection