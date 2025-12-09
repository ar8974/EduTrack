@extends('layouts.faculty')
@section('content')
<div class="container mt-3">
   <h2>Edit Exam</h2>
   @if ($errors->any())
   <div class="alert alert-danger">
      <strong>Fix the following errors:</strong>
      <ul>
         @foreach ($errors->all() as $e)
         <li>{{ $e }}</li>
         @endforeach
      </ul>
   </div>
   @endif
   <form method="POST" action="{{ route('faculty.exams.update', $exam->exam_id) }}">
      @csrf
      @method('PUT')
      {{-- SECTION --}}
      <div class="mb-3">
         <label class="form-label">Section</label>
         <select name="section_id" class="form-select" required>
            <option value="">-- Select Section --</option>
            @foreach($sections as $s)
            <option value="{{ $s->section_id }}"
            {{ old('section_id', $exam->section_id) == $s->section_id ? 'selected' : '' }}>
            {{ $s->section_id }} — {{ $s->course->course_name ?? '' }}
            </option>
            @endforeach
         </select>
      </div>
      {{-- TITLE --}}
      <div class="mb-3">
         <label class="form-label">Exam Title</label>
         <input type="text" name="title" class="form-control" required
            value="{{ old('title', $exam->title) }}">
      </div>
      {{-- DATE & TIME --}}
      <div class="mb-3">
         <label class="form-label">Exam Date & Time</label>
         <input type="datetime-local" name="exam_date" class="form-control" required
            value="{{ old('exam_date', \Carbon\Carbon::parse($exam->exam_date)->format('Y-m-d\TH:i')) }}">
      </div>
      {{-- DURATION --}}
      <div class="mb-3">
         <label class="form-label">Duration (minutes)</label>
         <input type="number" name="duration_minutes" class="form-control"
            min="1" required
            value="{{ old('duration_minutes', $exam->duration_minutes) }}">
      </div>
      <button class="btn btn-warning">Update Exam</button>
      <a href="{{ route('faculty.exams.index') }}" class="btn btn-secondary">Cancel</a>
   </form>
</div>
@endsection