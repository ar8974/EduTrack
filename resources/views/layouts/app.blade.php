<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Education Management System</title>
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
                  <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('announcements.index') }}">Announcements</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('departments.index') }}">Departments</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('courses.index') }}">Courses</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                     More
                     </a>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('sections.index') }}">Sections</a></li>
                        <li><a class="dropdown-item" href="{{ route('enrollments.index') }}">Enrollments</a></li>
                        <li><a class="dropdown-item" href="{{ route('assignments.index') }}">Assignments</a></li>
                        <li><a class="dropdown-item" href="{{ route('exams.index') }}">Exams</a></li>
                        <li><a class="dropdown-item" href="{{ route('rubrics.index') }}">Rubrics</a></li>
                        <li><a class="dropdown-item" href="{{ route('submissions.index') }}">Submissions</a></li>
                        <li><a class="dropdown-item" href="{{ route('threads.index') }}">Discussion Threads</a></li>
                        <li><a class="dropdown-item" href="{{ route('posts.index') }}">Discussion Posts</a></li>
                        <li><a class="dropdown-item" href="{{ route('messages.index') }}">Messages</a></li>
                     </ul>
                  </li>
               </ul>
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item dropdown me-3">
                     <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                     Messages
                     <span class="badge badge-notify">{{ $topbarMessageCount }}</span>
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end">
                        @foreach($topbarMessages as $msg)
                        <li class="ps-3">
                           {{ $msg->subject ?? 'No Subject' }}
                        </li>
                        @endforeach
                        <li>
                           <hr class="dropdown-divider">
                        </li>
                        <li>
                           <a class="dropdown-item text-center" href="{{ route('messages.index') }}">
                           View All
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <span class="nav-link text-white">
                     {{ Auth::user()->first_name }} ({{ Auth::user()->role->role_name }})
                     </span>
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
   </body>
</html>