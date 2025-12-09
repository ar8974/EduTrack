@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Exams</h2>
   <a href="{{ route('exams.create') }}" class="btn btn-primary">Add Exam</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Section</th>
         <th>Title</th>
         <th>Exam Date</th>
         <th>Duration (minutes)</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($exams as $exam)
      <tr>
         <td>{{ $exam->exam_id }}</td>
         <td>{{ $exam->section->course->course_name ?? '' }}</td>
         <td>{{ $exam->title }}</td>
         <td>{{ $exam->exam_date }}</td>
         <td>{{ $exam->duration_minutes }}</td>
         <td>
            <a href="{{ route('exams.edit', $exam) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('exams.destroy', $exam) }}" method="POST" style="display:inline-block;">
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