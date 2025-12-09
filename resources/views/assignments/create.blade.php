@extends('layouts.app')
@section('content')
<h2>Add Assignment</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ route('assignments.store') }}" method="POST">
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
      <label>Description</label>
      <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
   </div>
   <div class="mb-3">
      <label>Due Date</label>
      <input type="datetime-local" name="due_date" class="form-control" value="{{ old('due_date') }}" required>
   </div>
   <div class="mb-3">
      <label>Total Points</label>
      <input type="number" step="0.01" name="total_points" class="form-control" value="{{ old('total_points') }}" required>
   </div>
   <div class="mb-3 form-check">
      <input type="checkbox" name="is_team_based" class="form-check-input" value="1" {{ old('is_team_based') ? 'checked' : '' }}>
      <label class="form-check-label">Team Based</label>
   </div>
   <button class="btn btn-success">Create</button>
</form>
@endsection