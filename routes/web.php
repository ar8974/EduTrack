<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    RoleController,
    DepartmentController,
    CourseController,
    SectionController,
    EnrollmentController,
    AnnouncementController,
    AssignmentController,
    SubmissionController,
    RubricController,
    ExamController,
    QuestionController,
    ResponseController,
    AttendanceController,
    DiscussionThreadController,
    DiscussionPostController,
    MessageController,
    RoomController,
    TermController,
    LoginLogController,
    AuditLogController,
    DashboardController,
    UserImportExportController,
    AuthController
};

Route::get('/dashboard/summary', [App\Http\Controllers\DashboardSummaryController::class, 'summary'])->name('dashboard.summary');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('users/import_export', [UserImportExportController::class, 'index'])->name('users.import_export');
    Route::post('users/import', [UserImportExportController::class, 'import'])->name('users.import');
    Route::get('users/export', [UserImportExportController::class, 'export'])->name('users.export');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('messages', MessageController::class);
    Route::resource('assignments', AssignmentController::class);
    Route::resource('submissions', SubmissionController::class);
    Route::resource('rubrics', RubricController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('responses', ResponseController::class)->only(['index','store','destroy']);
    Route::resource('attendance', AttendanceController::class)->only(['index','create','store','destroy']);
    Route::resource('rooms', RoomController::class);
    Route::resource('terms', TermController::class);
    Route::resource('threads', DiscussionThreadController::class);
    Route::resource('posts', DiscussionPostController::class);

    Route::get('login-logs', [LoginLogController::class, 'index'])->name('login_logs.index');
    Route::get('login-logs/{log}', [LoginLogController::class, 'show'])->name('login_logs.show');
    Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit_logs.index');
    Route::get('audit-logs/{log}', [AuditLogController::class, 'show'])->name('audit_logs.show');
});

Route::middleware(['auth', 'role:Faculty'])->prefix('faculty')->as('faculty.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Faculty\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('sections', App\Http\Controllers\Faculty\SectionController::class);
    Route::resource('courses', App\Http\Controllers\Faculty\CourseController::class);
    Route::resource('sections', App\Http\Controllers\Faculty\SectionController::class);
    Route::resource('assignments', App\Http\Controllers\Faculty\AssignmentController::class);
    Route::resource('submissions', App\Http\Controllers\Faculty\SubmissionController::class);
    Route::resource('exams', App\Http\Controllers\Faculty\ExamController::class);
    Route::resource('responses', App\Http\Controllers\Faculty\ResponseController::class)->only(['index','store','destroy']);
    Route::resource('messages', App\Http\Controllers\Faculty\MessageController::class);
    Route::resource('announcements', App\Http\Controllers\Faculty\AnnouncementController::class);
    Route::resource('threads', App\Http\Controllers\Faculty\DiscussionThreadController::class);
    Route::resource('posts', App\Http\Controllers\Faculty\DiscussionPostController::class);
});


Route::middleware(['auth', 'role:Student'])->prefix('student')->as('student.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/enrollments', [App\Http\Controllers\Student\EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('/enrollments/enroll', [App\Http\Controllers\Student\EnrollmentController::class, 'create'])->name('enrollments.create');
    Route::post('/enrollments/enroll', [App\Http\Controllers\Student\EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('/enrollments/{id}/drop', [App\Http\Controllers\Student\EnrollmentController::class, 'drop'])->name('enrollments.drop');

    Route::resource('exams', App\Http\Controllers\Student\ExamController::class);
    Route::resource('announcements', App\Http\Controllers\Student\AnnouncementController::class);

    Route::get('/submissions', [App\Http\Controllers\Student\SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/submissions/view/{submissionId}', [App\Http\Controllers\Student\SubmissionController::class, 'show'])->name('submissions.show');

    Route::get('/assignments', [App\Http\Controllers\Student\AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/submit/{id}', [App\Http\Controllers\Student\AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments/submit/{id}', [App\Http\Controllers\Student\AssignmentController::class, 'store'])->name('assignments.store');

    Route::get('/messages', [\App\Http\Controllers\Student\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [\App\Http\Controllers\Student\MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [\App\Http\Controllers\Student\MessageController::class, 'store'])->name('messages.store');
});

