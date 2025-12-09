@extends('layouts.app')
@section('content')
<h2>Edit Enrollment</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ route('enrollments.update', $enrollment->enrollment_id) }}" method="POST">
   @csrf
   @method('PUT')
   <div class="mb-3">
      <label>Student</label>
      <select name="student_id" class="form-control" required>
         <option value="">Select Student</option>
         @foreach($students as $s)
         <option value="{{ $s->user_id }}" {{ old('student_id', $enrollment->student_id) == $s->user_id ? 'selected' : '' }}>
         {{ $s->first_name }} {{ $s->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Section</label>
      <select name="section_id" class="form-control" required>
         <option value="">Select Section</option>
         @foreach($sections as $section)
         <option value="{{ $section->section_id }}" {{ old('section_id', $enrollment->section_id) == $section->section_id ? 'selected' : '' }}>
         {{ $section->course->course_code ?? '' }} - Section {{ $section->section_id }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Enrolled On</label>
      <input type="date" name="enrolled_on" class="form-control" value="{{ old('enrolled_on', $enrollment->enrolled_on) }}" required>
   </div>
   <div class="mb-3">
      <label>Final Grade</label>
      <input type="number" step="0.01" name="final_grade" class="form-control" value="{{ old('final_grade', $enrollment->final_grade) }}">
   </div>
   <button class="btn btn-primary">Update</button>
</form>
@endsection