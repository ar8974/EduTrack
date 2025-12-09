@extends('student.layouts.app')
@section('content')
<div class="container mt-4">
   <h2 class="mb-4">Announcements</h2>
   @if($announcements->isEmpty())
   <div class="alert alert-info">No announcements available.</div>
   @else
   <div class="list-group">
      @foreach($announcements as $a)
      <div class="list-group-item mb-3 shadow-sm rounded">
         <h5 class="fw-bold">{{ $a->title }}</h5>
         <p class="text-muted mb-1">
            {{ $a->section->course->course_code }} - 
            {{ $a->section->course->course_name }}
         </p>
         <p class="mb-2">{{ $a->message }}</p>
         <small class="text-secondary">
         Posted on: 
         {{ \Carbon\Carbon::parse($a->posted_on)->format('F d, Y h:i A') }}
         </small>
      </div>
      @endforeach
   </div>
   @endif
</div>
@endsection