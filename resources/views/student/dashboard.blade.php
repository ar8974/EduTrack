@extends('student.layouts.app')
@section('content')
<div class="container-fluid mt-4">
   <div class="row g-3 mb-4">
      <div class="col-md-3">
         <div class="card shadow-sm border-0">
            <div class="card-body text-center py-4">
               <h5 class="card-title text-muted">Enrolled Courses</h5>
               <h1 class="display-5 fw-bold">{{ $courseCount }}</h1>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="card shadow-sm border-0">
            <div class="card-body text-center py-4">
               <h5 class="card-title text-muted">Assignments</h5>
               <h1 class="display-5 fw-bold">{{ $assignmentCount }}</h1>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="card shadow-sm border-0">
            <div class="card-body text-center py-4">
               <h5 class="card-title text-muted">Exams</h5>
               <h1 class="display-5 fw-bold">{{ $examCount }}</h1>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="card shadow-sm border-0">
            <div class="card-body text-center py-4">
               <h5 class="card-title text-muted">Submissions</h5>
               <h1 class="display-5 fw-bold">{{ $submissionCount }}</h1>
            </div>
         </div>
      </div>
   </div>
   <div class="row g-4">
      <div class="col-lg-6">
         <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-0">
               <h5 class="fw-bold mb-0">Recent Announcements</h5>
            </div>
            <div class="card-body">
               @if ($recentAnnouncements->isEmpty())
               <p class="text-muted mb-0">No announcements yet.</p>
               @else
               <ul class="list-group list-group-flush">
                  @foreach ($recentAnnouncements as $a)
                  <li class="list-group-item">
                     <strong>{{ $a->title }}</strong><br>
                     <small class="text-muted">
                     {{ $a->posted_on }} — {{ $a->section->course->course_name ?? 'Course' }}
                     </small>
                  </li>
                  @endforeach
               </ul>
               @endif
            </div>
         </div>
      </div>
   </div>
   <div class="row g-4 mt-4">
      <div class="col-lg-6">
         <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-0">
               <h5 class="fw-bold mb-0">Recent Grades</h5>
            </div>
            <div class="card-body">
               @if ($recentGrades->isEmpty())
               <p class="text-muted mb-0">No graded submissions yet.</p>
               @else
               <table class="table table-borderless align-middle">
                  <tbody>
                     @foreach ($recentGrades as $g)
                     <tr>
                        <td>
                           <strong>{{ $g->assignment->title ?? 'Assignment' }}</strong><br>
                           <small class="text-muted">
                           Submitted: {{ $g->submitted_on }}
                           </small>
                        </td>
                        <td class="text-end">
                           <span class="badge bg-success p-2">
                           {{ $g->grade ?? 'Not graded' }}
                           </span>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               @endif
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-0">
               <h5 class="fw-bold mb-0">Upcoming Exams</h5>
            </div>
            <div class="card-body">
               @if ($upcomingExams->isEmpty())
               <p class="text-muted mb-0">No scheduled exams.</p>
               @else
               <table class="table table-borderless align-middle">
                  <tbody>
                     @foreach ($upcomingExams as $ex)
                     <tr>
                        <td>
                           <strong>{{ $ex->title }}</strong><br>
                           <small class="text-muted">
                           Date: {{ $ex->exam_date }} |
                           {{ $ex->section->course->course_name ?? '' }}
                           </small>
                        </td>
                        <td class="text-end">
                           <a href="{{ route('student.exams.show', $ex->exam_id) }}" 
                              class="btn btn-sm btn-outline-primary">
                           Details
                           </a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection