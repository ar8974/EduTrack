@extends('layouts.app')
@section('content')
<h2>Add Course</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach ($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ route('courses.store') }}" method="POST">
   @csrf
   <div class="mb-3">
      <label>Course Code</label>
      <input type="text" name="course_code" class="form-control" value="{{ old('course_code') }}" required>
   </div>
   <div class="mb-3">
      <label>Course Name</label>
      <input type="text" name="course_name" class="form-control" value="{{ old('course_name') }}" required>
   </div>
   <div class="mb-3">
      <label>Description</label>
      <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
   </div>
   <div class="mb-3">
      <label>Department</label>
      <select name="dept_id" class="form-control" required>
         <option value="">Select Department</option>
         @foreach($departments as $dept)
         <option value="{{ $dept->dept_id }}" {{ old('dept_id') == $dept->dept_id ? 'selected' : '' }}>
         {{ $dept->dept_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Credits</label>
      <input type="number" name="credits" class="form-control" value="{{ old('credits') }}" required min="0">
   </div>
   <button class="btn btn-success">Create</button>
</form>
@endsection