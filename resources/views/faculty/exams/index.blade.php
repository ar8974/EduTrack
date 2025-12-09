@extends('faculty.layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>My Exams</h2>
   <a href="{{ route('faculty.exams.create') }}" class="btn btn-primary">Create Exam</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Title</th>
         <th>Course</th>
         <th>Section</th>
         <th>Date & Time</th>
         <th>Duration (mins)</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($exams as $exam)
      <tr>
         <td>{{ $exam->exam_id }}</td>
         <td>{{ $exam->title }}</td>
         <td>{{ $exam->section->course->course_name ?? 'N/A' }}</td>
         <td>{{ $exam->section->section_id ?? 'N/A' }}</td>
         <td>{{ $exam->exam_date }}</td>
         <td>{{ $exam->duration_minutes }}</td>
         <td>
            <a href="{{ route('faculty.exams.edit', $exam->exam_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('faculty.exams.destroy', $exam->exam_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this exam?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection