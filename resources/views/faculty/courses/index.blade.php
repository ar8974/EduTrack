@extends('faculty.layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>My Courses</h2>
   <a href="{{ route('faculty.courses.create') }}" class="btn btn-primary">Add Course</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered table-striped">
   <thead>
      <tr>
         <th>ID</th>
         <th>Course Code</th>
         <th>Title</th>
         <th>Department</th>
         <th>Sections</th>
         <th>Students</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($courses as $course)
      <tr>
         <td>{{ $course->course_id }}</td>
         <td>{{ $course->course_code }}</td>
         <td>{{ $course->course_name }}</td>
         <td>{{ $course->department->dept_name ?? 'N/A' }}</td>
         <td>{{ $course->sections->count() }}</td>
         <td>
            {{ $course->sections->sum(function($section) {
            return $section->enrollments->count();
            }) }}
         </td>
         <td>
            <a href="{{ route('faculty.courses.edit', $course) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('faculty.courses.destroy', $course) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection