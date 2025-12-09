@extends('faculty.layouts.app')
@section('content')
<div class="container mt-3">
   <h2>{{ isset($exam) ? 'Edit Exam' : 'Create Exam' }}</h2>
   <form method="POST" action="{{ isset($exam) ? route('faculty.exams.update', $exam->exam_id) : route('faculty.exams.store') }}">
      @csrf
      @if(isset($exam)) @method('PUT') @endif
      <div class="mb-3">
         <label class="form-label">Section</label>
         <select name="section_id" class="form-select" required>
            <option value="">-- Select Section --</option>
            @foreach($sections as $s)
            <option value="{{ $s->section_id }}"
            {{ (old('section_id') ?? ($exam->section_id ?? '')) == $s->section_id ? 'selected' : '' }}>
            {{ $s->section_id }} — {{ $s->course->course_name ?? '' }}
            </option>
            @endforeach
         </select>
      </div>
      <div class="mb-3">
         <label class="form-label">Title</label>
         <input type="text" name="title" class="form-control" required
            value="{{ old('title', $exam->title ?? '') }}">
      </div>
      <div class="mb-3">
         <label class="form-label">Date & Time</label>
         <input type="datetime-local" name="exam_date" class="form-control" required
            value="{{ old('exam_date', isset($exam) && $exam->exam_date ? \Carbon\Carbon::parse($exam->exam_date)->format('Y-m-d\TH:i') : '') }}">
      </div>
      <div class="mb-3">
         <label class="form-label">Duration (minutes)</label>
         <input type="number" name="duration_minutes" class="form-control" min="1" required
            value="{{ old('duration_minutes', $exam->duration_minutes ?? '') }}">
      </div>
      <button class="btn btn-success">{{ isset($exam) ? 'Update Exam' : 'Create Exam' }}</button>
      <a href="{{ route('faculty.exams.index') }}" class="btn btn-secondary">Cancel</a>
   </form>
</div>
@endsection