@extends('faculty.layouts.app')
@section('content')
<div class="container mt-4">
   <h2 class="mb-4">Faculty Dashboard</h2>
   {{-- TOP STATS --}}
   <div class="row g-4">
      <div class="col-md-4 col-lg-3">
         <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
               <div class="display-5 fw-bold text-primary">{{ $courses }}</div>
               <p class="card-text text-muted">Courses</p>
            </div>
         </div>
      </div>
      <div class="col-md-4 col-lg-3">
         <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
               <div class="display-5 fw-bold text-success">{{ count($sections) }}</div>
               <p class="card-text text-muted">Sections</p>
            </div>
         </div>
      </div>
      <div class="col-md-4 col-lg-3">
         <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
               <div class="display-5 fw-bold text-warning">{{ $assignments }}</div>
               <p class="card-text text-muted">Assignments</p>
            </div>
         </div>
      </div>
      <div class="col-md-4 col-lg-3">
         <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
               <div class="display-5 fw-bold text-danger">{{ $submissions }}</div>
               <p class="card-text text-muted">Submissions</p>
            </div>
         </div>
      </div>
      <div class="col-md-4 col-lg-3">
         <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
               <div class="display-5 fw-bold text-info">{{ $announcements }}</div>
               <p class="card-text text-muted">Announcements</p>
            </div>
         </div>
      </div>
      <div class="col-md-4 col-lg-3">
         <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
               <div class="display-5 fw-bold text-secondary">{{ $exams }}</div>
               <p class="card-text text-muted">Exams</p>
            </div>
         </div>
      </div>
   </div>
   <hr class="my-5">
   {{-- Tables Preview --}}
   <div class="row g-4">
      <div class="col-md-6">
         <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
               <strong>Your Sections</strong>
            </div>
            <div class="card-body p-0">
               <table class="table table-hover mb-0">
                  <thead class="table-light">
                     <tr>
                        <th>Section ID</th>
                        <th>Course</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($sections as $section)
                     <tr>
                        <td>{{ $section }}</td>
                        <td>Course #?</td>
                        {{-- Replace if needed --}}
                     </tr>
                     @empty
                     <tr>
                        <td colspan="2" class="text-center text-muted py-3">No Sections</td>
                     </tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
               <strong>Quick Actions</strong>
            </div>
            <div class="list-group list-group-flush">
               <a href="{{ route('faculty.courses.index') }}" class="list-group-item list-group-item-action">View Courses</a>
               <a href="{{ route('faculty.sections.index') }}" class="list-group-item list-group-item-action">Manage Sections</a>
               <a href="{{ route('faculty.assignments.index') }}" class="list-group-item list-group-item-action">Assignments</a>
               <a href="{{ route('faculty.submissions.index') }}" class="list-group-item list-group-item-action">Submissions</a>
               <a href="{{ route('faculty.exams.index') }}" class="list-group-item list-group-item-action">Exams</a>
               <a href="{{ route('faculty.announcements.index') }}" class="list-group-item list-group-item-action">Announcements</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection