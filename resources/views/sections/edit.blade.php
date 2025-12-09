@extends('layouts.faculty')
@section('content')
<div class="container mt-4">
   <h2>{{ isset($section) ? 'Edit Section' : 'Create Section' }}</h2>
   <form action="{{ isset($section) ? route('faculty.sections.update', $section) : route('faculty.sections.store') }}" method="POST">
      @csrf
      @if(isset($section))
      @method('PUT')
      @endif
      <div class="mb-3">
         <label class="form-label">Course</label>
         <select name="course_id" class="form-select" required>
            <option value="">-- Select Course --</option>
            @foreach($courses as $course)
            <option value="{{ $course->course_id }}"
            {{ (isset($section) && $section->course_id == $course->course_id) ? 'selected' : '' }}>
            {{ $course->course_name }}
            </option>
            @endforeach
         </select>
      </div>
      <div class="mb-3">
         <label class="form-label">Term</label>
         <select name="term_id" class="form-select" required>
            <option value="">-- Select Term --</option>
            @foreach($terms as $term)
            <option value="{{ $term->term_id }}"
            {{ (isset($section) && $section->term_id == $term->term_id) ? 'selected' : '' }}>
            {{ $term->term_name }}
            </option>
            @endforeach
         </select>
      </div>
      <div class="mb-3">
         <label class="form-label">Schedule Day</label>
         <input type="text" name="schedule_day" class="form-control" required
            value="{{ $section->schedule_day ?? old('schedule_day') }}">
      </div>
      <div class="mb-3">
         <label class="form-label">Start Time</label>
         <input type="time" name="start_time" class="form-control" required
            value="{{ $section->start_time ?? old('start_time') }}">
      </div>
      <div class="mb-3">
         <label class="form-label">End Time</label>
         <input type="time" name="end_time" class="form-control" required
            value="{{ $section->end_time ?? old('end_time') }}">
      </div>
      <div class="mb-3">
         <label class="form-label">Room</label>
         <select name="room_id" class="form-select" required>
            <option value="">-- Select Room --</option>
            @foreach($rooms as $room)
            <option value="{{ $room->room_id }}"
            {{ (isset($section) && $section->room_id == $room->room_id) ? 'selected' : '' }}>
            {{ $room->room_name }}
            </option>
            @endforeach
         </select>
      </div>
      <div class="mb-3">
         <label class="form-label">Capacity</label>
         <input type="number" name="capacity" class="form-control" required min="1"
            value="{{ $section->capacity ?? old('capacity') }}">
      </div>
      <button class="btn btn-success">{{ isset($section) ? 'Update Section' : 'Create Section' }}</button>
   </form>
</div>
@endsection