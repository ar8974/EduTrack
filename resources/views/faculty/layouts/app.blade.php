<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Faculty Dashboard | EduTrack</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
         .badge-notify { background: red; color: white; font-size: 0.75rem; position: relative; top: -5px; left: -5px; }
      </style>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
         <div class="container-fluid">
            <a class="navbar-brand fw-bold">EduTrack</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav me-auto">
                  <li class="nav-item"><a class="nav-link" href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('faculty.announcements.index') }}">Announcements</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('faculty.assignments.index') }}">Assignments</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('faculty.submissions.index') }}">Submissions</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('faculty.courses.index') }}">Courses</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('faculty.sections.index') }}">Sections</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('faculty.exams.index') }}">Exams</a></li>
               </ul>
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item"><a class="nav-link" href="{{ route('faculty.messages.index') }}">Messages</a></li>
                  <li class="nav-item">
                     <span class="nav-link text-white">{{ Auth::user()->first_name }} ({{ Auth::user()->role->role_name }})</span>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-white" href="{{ route('logout') }}">Logout</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <div class="container mt-4">
         @if(session('success'))
         <div class="alert alert-success">{{ session('success') }}</div>
         @endif
         @yield('content')
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      @yield('scripts')
   </body>
</html>