@@extends('student.layouts.app')
('layouts.app')
@section('content')
<div class="container mt-4">
   <h2 class="mb-4">Enroll in a Class</h2>
   @if(session('error'))
   <div class="alert alert-danger">{{ session('error') }}</div>
   @endif
   @if($sections->isEmpty())
   <div class="alert alert-info">
      No available sections to enroll in.
   </div>
   @else
   <div class="row">
      @foreach($sections as $sec)
      <div class="col-md-6">
         <div class="card shadow-sm mb-3">
            <div class="card-body">
               <h5 class="card-title">
                  {{ $sec->course->course_code }} — {{ $sec->course->course_name }}
               </h5>
               <p class="mb-1"><strong>Section ID:</strong> {{ $sec->section_id }}</p>
               <p class="mb-1">
                  <strong>Instructor:</strong>
                  {{ $sec->faculty->first_name ?? '' }}
                  {{ $sec->faculty->last_name ?? '' }}
               </p>
               <p class="mb-1">
                  <strong>Schedule:</strong>
                  {{ $sec->schedule_day }}
                  {{ $sec->start_time }} – {{ $sec->end_time }}
               </p>
               <p class="mb-2"><strong>Capacity:</strong> {{ $sec->capacity }}</p>
               <form method="POST" action="{{ route('student.enrollments.store') }}">
                  @csrf
                  <input type="hidden" name="section_id" value="{{ $sec->section_id }}">
                  <button class="btn btn-success btn-sm">Enroll</button>
               </form>
            </div>
         </div>
      </div>
      @endforeach
   </div>
   @endif
</div>
@endsection