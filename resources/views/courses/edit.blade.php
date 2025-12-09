@extends('layouts.app')
@section('content')
<h2>Edit Course</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach ($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ route('courses.update', $course->course_id) }}" method="POST">
   @csrf
   @method('PUT')
   <div class="mb-3">
      <label>Course Code</label>
      <input type="text" name="course_code" class="form-control" value="{{ old('course_code', $course->course_code) }}" required>
   </div>
   <div class="mb-3">
      <label>Course Name</label>
      <input type="text" name="course_name" class="form-control" value="{{ old('course_name', $course->course_name) }}" required>
   </div>
   <div class="mb-3">
      <label>Description</label>
      <textarea name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
   </div>
   <div class="mb-3">
      <label>Department</label>
      <select name="dept_id" class="form-control" required>
         <option value="">Select Department</option>
         @foreach($departments as $dept)
         <option value="{{ $dept->dept_id }}" {{ old('dept_id', $course->dept_id) == $dept->dept_id ? 'selected' : '' }}>
         {{ $dept->dept_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Credits</label>
      <input type="number" name="credits" class="form-control" value="{{ old('credits', $course->credits) }}" required min="0">
   </div>
   <button class="btn btn-primary">Update</button>
</form>
@endsection