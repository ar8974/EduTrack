<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>EduTrack | Login</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Poppins", sans-serif;
        }
        .login-card {
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background-color: #fff;
            padding: 30px;
        }
        .login-card h3 {
            margin-bottom: 15px;
        }
        @media (prefers-color-scheme: dark) {
        body {
            background-color: #121212;
            color: #e9ecef;
        }
        .login-card {
            background-color: #1e1e1e;
            color: #e9ecef;
        }
        .form-control {
            background-color: #2c2c2c;
            color: #e9ecef;
            border-color: #555;
        }
        .form-control:focus {
            background-color: #2c2c2c;
            color: #e9ecef;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        }
      </style>
   </head>
   <body>
      <div class="login-card">
         <h3 class="text-center">EduTrack Login</h3>
         <p class="text-center mb-4" style="font-size: 14px; color: #ccc">
            Enter your credentials to access the dashboard.
         </p>
         @if(session('error'))
         <div class="alert alert-danger">{{ session('error') }}</div>
         @endif
         <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
               <label class="form-label">Role</label>
               <select name="role" class="form-select" required>
                  <option value="">-- Choose Role --</option>
                  <option value="ADMIN">Admin</option>
                  <option value="FACULTY">Faculty</option>
                  <option value="STUDENT">Student</option>
               </select>
            </div>
            <div class="mb-3">
               <label class="form-label">Email</label>
               <input type="text" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
               <label class="form-label">Password</label>
               <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100 mt-2">Login</button>
         </form>
         <p class="text-center mt-3" style="font-size: 14px; color: #ccc">
            &copy; {{ date('Y') }} EduTrack Management System
         </p>
      </div>
   </body>
</html>