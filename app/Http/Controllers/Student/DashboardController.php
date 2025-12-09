<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Models\Enrollment;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Announcement;
use App\Models\Exam;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $studentId = Session::get('user_id');

        $sections = Enrollment::where('student_id', $studentId)->pluck('section_id');

        $courseCount = Enrollment::where('student_id', $studentId)->count();
        $assignmentCount = Assignment::whereIn('section_id', $sections)->count();
        $announcementCount = Announcement::whereIn('section_id', $sections)->count();
        $examCount = Exam::whereIn('section_id', $sections)->count();
        $submissionCount = Submission::where('student_id', $studentId)->count();

        $recentAnnouncements = Announcement::whereIn('section_id', $sections)
            ->orderBy('posted_on', 'desc')
            ->limit(5)
            ->get();

        $upcomingAssignments = Assignment::whereIn('section_id', $sections)
            ->whereDate('due_date', '>=', Carbon::today())
            ->orderBy('due_date')
            ->limit(5)
            ->get();

        $recentGrades = Submission::where('student_id', $studentId)
            ->orderBy('submitted_on', 'desc')
            ->limit(5)
            ->get();

        $upcomingExams = Exam::whereIn('section_id', $sections)
            ->whereDate('exam_date', '>=', Carbon::today())
            ->orderBy('exam_date')
            ->limit(5)
            ->get();

        return view('student.dashboard', compact(
            'courseCount',
            'assignmentCount',
            'announcementCount',
            'examCount',
            'submissionCount',
            'recentAnnouncements',
            'upcomingAssignments',
            'recentGrades',
            'upcomingExams'
        ));
    }
}
