@extends('student.layouts.app')
@section('content')
<div class="container mt-4">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>My Enrollments</h2>
      <a href="{{ route('student.enrollments.create') }}" class="btn btn-primary">
      Enroll in a Class
      </a>
   </div>
   @if(session('success'))
   <div class="alert alert-success">{{ session('success') }}</div>
   @endif
   @if($enrollments->isEmpty())
   <div class="alert alert-info">
      You are not enrolled in any classes.
   </div>
   @endif
   <div class="row">
      @foreach($enrollments as $enr)
      <div class="col-md-6">
         <div class="card shadow-sm mb-3">
            <div class="card-body">
               <h5 class="card-title">
                  {{ $enr->section->course->course_code }} —
                  {{ $enr->section->course->course_name }}
               </h5>
               <p><strong>Section:</strong> {{ $enr->section->section_id }}</p>
               <p><strong>Schedule:</strong>
                  {{ $enr->section->schedule_day }}
                  {{ $enr->section->start_time }} – {{ $enr->section->end_time }}
               </p>
               <p><strong>Instructor:</strong>
                  {{ $enr->section->faculty->first_name ?? '' }}
                  {{ $enr->section->faculty->last_name ?? '' }}
               </p>
               <form method="POST"
                  action="{{ route('student.enrollments.drop', $enr->enrollment_id) }}"
                  onsubmit="return confirm('Drop this course?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm">Drop</button>
               </form>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>
@endsection