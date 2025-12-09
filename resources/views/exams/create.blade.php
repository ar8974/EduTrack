@extends('layouts.app')
@section('content')
<h2>Add Exam</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ route('exams.store') }}" method="POST">
   @csrf
   <div class="mb-3">
      <label>Section</label>
      <select name="section_id" class="form-control" required>
         <option value="">Select Section</option>
         @foreach($sections as $section)
         <option value="{{ $section->section_id }}" {{ old('section_id') == $section->section_id ? 'selected' : '' }}>
         {{ $section->course->course_code ?? '' }} - Section {{ $section->section_id }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Title</label>
      <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
   </div>
   <div class="mb-3">
      <label>Exam Date & Time</label>
      <input type="datetime-local" name="exam_date" class="form-control" value="{{ old('exam_date') }}" required>
   </div>
   <div class="mb-3">
      <label>Duration (minutes)</label>
      <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes') }}" min="1" required>
   </div>
   <button class="btn btn-success">Create</button>
</form>
@endsection