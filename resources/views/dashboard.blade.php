@extends('layouts.app') @section('content')
<div class="container mt-4">
   @if(session('success'))
   <div class="alert alert-success">{{ session('success') }}</div>
   @endif
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-2">
            <div class="list-group mb-4">
               <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action active">
               Dashboard
               </a>
               <a href="{{ route('dashboard.summary') }}" class="list-group-item list-group-item-action">
               Summary
               </a>
               {{-- USERS --}}
               <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action"> Users </a>
               <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action"> Roles </a>
               {{-- DEPARTMENTS --}}
               <a href="{{ route('departments.index') }}" class="list-group-item list-group-item-action">
               Departments
               </a>
               {{-- COURSES & SECTIONS --}}
               <a href="{{ route('courses.index') }}" class="list-group-item list-group-item-action"> Courses </a>
               <a href="{{ route('sections.index') }}" class="list-group-item list-group-item-action">
               Sections
               </a>
               {{-- ENROLLMENTS --}}
               <a href="{{ route('enrollments.index') }}" class="list-group-item list-group-item-action">
               Enrollments
               </a>
               {{-- ASSIGNMENTS --}}
               <a href="{{ route('assignments.index') }}" class="list-group-item list-group-item-action">
               Assignments
               </a>
               {{-- SUBMISSIONS --}}
               <a href="{{ route('submissions.index') }}" class="list-group-item list-group-item-action">
               Submissions
               </a>
               {{-- RUBRICS --}}
               <a href="{{ route('rubrics.index') }}" class="list-group-item list-group-item-action"> Rubrics </a>
               {{-- EXAMS --}}
               <a href="{{ route('exams.index') }}" class="list-group-item list-group-item-action"> Exams </a>
               {{-- DISCUSSION THREADS AND POSTS --}}
               <a href="{{ route('threads.index') }}" class="list-group-item list-group-item-action">
               Discussion Threads
               </a>
               <a href="{{ route('posts.index') }}" class="list-group-item list-group-item-action">
               Discussion Posts
               </a>
               {{-- ANNOUNCEMENTS --}}
               <a href="{{ route('announcements.index') }}" class="list-group-item list-group-item-action">
               Announcements
               </a>
            </div>
         </div>
         <div class="col-md-10">
            <div class="row mb-4">
               <div class="col-md-3">
                  <div class="p-3 bg-primary text-white rounded shadow-sm">
                     <h5>Users</h5>
                     <h3>{{ $userCount }}</h3>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="p-3 bg-success text-white rounded shadow-sm">
                     <h5>Courses</h5>
                     <h3>{{ $courseCount }}</h3>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="p-3 bg-warning text-white rounded shadow-sm">
                     <h5>Assignments</h5>
                     <h3>{{ $assignmentCount }}</h3>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="p-3 bg-danger text-white rounded shadow-sm">
                     <h5>Submissions</h5>
                     <h3>{{ $submissionCount }}</h3>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <h4>Recent Announcements</h4>
                  <ul class="list-group mb-4">
                     @foreach($recentAnnouncements as $a)
                     <li class="list-group-item">
                        <strong>{{ $a->title }}</strong><br />
                        <small>{{ \Carbon\Carbon::parse($a->posted_on)->format('d M Y') }}</small>
                        <p>{{ Str::limit($a->message, 120) }}</p>
                     </li>
                     @endforeach
                  </ul>
               </div>
               <div class="col-md-6">
                  <h4>Recent Assignments</h4>
                  <ul class="list-group mb-4">
                     @foreach($recentAssignments as $as)
                     <li class="list-group-item">
                        <strong>{{ $as->title }}</strong><br />
                        <small>Due: {{ \Carbon\Carbon::parse($as->due_date)->format('d M Y') }}</small>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <h4>Recent Submissions</h4>
                  <ul class="list-group mb-4">
                     @foreach($recentSubmissions as $s)
                     <li class="list-group-item">
                        Student #{{ $s->student_id }} submitted assignment #{{ $s->assignment_id }}
                        <br /><small>{{ \Carbon\Carbon::parse($s->submitted_on)->format('d M Y H:i') }}</small>
                     </li>
                     @endforeach
                  </ul>
               </div>
               <div class="col-md-6">
                  <h4>Recent Discussion Threads</h4>
                  <ul class="list-group mb-4">
                     @foreach($recentThreads as $t)
                     <li class="list-group-item">
                        <strong>{{ $t->title }}</strong><br />
                        <small>{{ \Carbon\Carbon::parse($t->created_on)->format('d M Y') }}</small>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endsection
</div>