@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Courses</h2>
   <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Code</th>
         <th>Name</th>
         <th>Description</th>
         <th>Department</th>
         <th>Credits</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @forelse($courses as $course)
      <tr>
         <td>{{ $course->course_id }}</td>
         <td>{{ $course->course_code }}</td>
         <td>{{ $course->course_name }}</td>
         <td>{{ Str::limit($course->description, 80) }}</td>
         <td>{{ $course->department->dept_name ?? '' }}</td>
         <td>{{ $course->credits }}</td>
         <td>
            <a href="{{ route('courses.edit', $course->course_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('courses.destroy', $course->course_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')">Delete</button>
            </form>
         </td>
      </tr>
      @empty
      <tr>
         <td colspan="7" class="text-center">No courses found</td>
      </tr>
      @endforelse
   </tbody>
</table>
@endsection