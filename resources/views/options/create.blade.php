@extends('layouts.app')
@section('content')
<h2>{{ isset($option) ? 'Edit Option' : 'Add Option' }}</h2>
<form action="{{ isset($option) ? route('options.update', $option) : route('options.store') }}" method="POST">
   @csrf
   @if(isset($option))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Question</label>
      <select name="question_id" class="form-control" required>
         <option value="">Select Question</option>
         @foreach($questions as $question)
         <option value="{{ $question->question_id }}" {{ (isset($option) && $option->question_id == $question->question_id) ? 'selected' : '' }}>
         {{ $question->question_text }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Option Text</label>
      <input type="text" name="option_text" class="form-control" value="{{ $option->option_text ?? old('option_text') }}" required>
   </div>
   <div class="mb-3 form-check">
      <input type="checkbox" name="is_correct" class="form-check-input" value="1" {{ (isset($option) && $option->is_correct) ? 'checked' : '' }}>
      <label class="form-check-label">Correct Option</label>
   </div>
   <button class="btn btn-success">Save</button>
</form>
@endsection