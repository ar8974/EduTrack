@extends('student.layouts.app')
@section('content')
<div class="container mt-4">
   <h2 class="mb-4">My Upcoming Exams</h2>
   @if($exams->isEmpty())
   <div class="alert alert-info">
      No exams scheduled for your enrolled courses.
   </div>
   @endif
   <div class="row">
      @foreach($exams as $exam)
      <div class="col-md-6 mb-4">
         <div class="card shadow-sm h-100">
            <div class="card-body">
               <h4 class="card-title mb-2">{{ $exam->title }}</h4>
               <p class="text-muted mb-2">
                  {{ $exam->section->course->course_code }}
                  — {{ $exam->section->course->course_name }}
               </p>
               <p class="mb-1"><strong>Exam Date:</strong>
                  {{ \Carbon\Carbon::parse($exam->exam_date)->format('F d, Y') }}
               </p>
               <p class="mb-1"><strong>Time:</strong>
                  {{ \Carbon\Carbon::parse($exam->start_time)->format('h:i A') }}
                  –
                  {{ \Carbon\Carbon::parse($exam->end_time)->format('h:i A') }}
               </p>
               <p class="mb-0"><strong>Section:</strong>
                  {{ $exam->section_id }}
               </p>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>
@endsection