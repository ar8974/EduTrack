@extends('faculty.layouts.app')
@section('content')
<div class="container mt-4">
   <h2>{{ isset($course) ? 'Edit Course' : 'Create Course' }}</h2>
   <form action="{{ isset($course) ? route('faculty.courses.update', $course) : route('faculty.courses.store') }}" method="POST">
      @csrf
      @if(isset($course))
      @method('PUT')
      @endif
      <div class="mb-3">
         <label class="form-label">Course Code</label>
         <input type="text" name="course_code" class="form-control" required
            value="{{ $course->course_code ?? old('course_code') }}">
      </div>
      <div class="mb-3">
         <label class="form-label">Course Name</label>
         <input type="text" name="course_name" class="form-control" required
            value="{{ $course->course_name ?? old('course_name') }}">
      </div>
      <div class="mb-3">
         <label class="form-label">Description</label>
         <textarea name="description" class="form-control" rows="3">{{ $course->description ?? old('description') }}</textarea>
      </div>
      <div class="mb-3">
         <label class="form-label">Department</label>
         <select name="dept_id" class="form-select" required>
            <option value="">-- Select Department --</option>
            @foreach($departments as $dept)
            <option value="{{ $dept->dept_id }}"
            {{ (isset($course) && $course->dept_id == $dept->dept_id) ? 'selected' : '' }}>
            {{ $dept->dept_name }}
            </option>
            @endforeach
         </select>
      </div>
      <div class="mb-3">
         <label class="form-label">Credits</label>
         <input type="number" name="credits" class="form-control" required min="0"
            value="{{ $course->credits ?? old('credits') }}">
      </div>
      <button class="btn btn-success">{{ isset($course) ? 'Update Course' : 'Create Course' }}</button>
   </form>
</div>
@endsection