@extends('layouts.app')
@section('content')
<h2>{{ isset($attendance) ? 'Edit Attendance' : 'Mark Attendance' }}</h2>
<form action="{{ isset($attendance) ? route('attendance.update', $attendance) : route('attendance.store') }}" method="POST">
   @csrf
   @if(isset($attendance))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Section</label>
      <select name="section_id" class="form-control" required>
         <option value="">Select Section</option>
         @foreach($sections as $section)
         <option value="{{ $section->section_id }}" {{ (isset($attendance) && $attendance->section_id == $section->section_id) ? 'selected' : '' }}>
         {{ $section->course->course_name ?? '' }} ({{ $section->schedule_day ?? '' }})
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Student</label>
      <select name="student_id" class="form-control" required>
         <option value="">Select Student</option>
         @foreach($students as $student)
         <option value="{{ $student->user_id }}" {{ (isset($attendance) && $attendance->student_id == $student->user_id) ? 'selected' : '' }}>
         {{ $student->first_name }} {{ $student->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Date</label>
      <input type="date" name="attendance_date" class="form-control" value="{{ $attendance->attendance_date ?? old('attendance_date') }}" required>
   </div>
   <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control" required>
         <option value="">Select Status</option>
         <option value="Present" {{ (isset($attendance) && $attendance->status == 'Present') ? 'selected' : '' }}>Present</option>
         <option value="Absent" {{ (isset($attendance) && $attendance->status == 'Absent') ? 'selected' : '' }}>Absent</option>
         <option value="Late" {{ (isset($attendance) && $attendance->status == 'Late') ? 'selected' : '' }}>Late</option>
      </select>
   </div>
   <div class="mb-3">
      <label>Marked By</label>
      <select name="marked_by" class="form-control" required>
         <option value="">Select Faculty/Admin</option>
         @foreach($users as $user)
         <option value="{{ $user->user_id }}" {{ (isset($attendance) && $attendance->marked_by == $user->user_id) ? 'selected' : '' }}>
         {{ $user->first_name }} {{ $user->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <button class="btn btn-success">Save</button>
</form>
@endsection