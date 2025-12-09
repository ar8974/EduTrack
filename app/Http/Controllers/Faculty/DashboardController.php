<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Models\Course;
use App\Models\Section;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Exam;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function index()
    {
        $facultyId = Session::get('user_id');

        // Courses directly owned
        $courses = Course::where('faculty_id', $facultyId)->count();

        // Sections taught by faculty
        $sections = Section::where('faculty_id', $facultyId)->pluck('section_id');

        $announcements = Announcement::where('posted_by', $facultyId)->count();


        // Assignments via sections
        $assignments = Assignment::whereIn('section_id', $sections)->count();

        // Submissions via assignment → section → faculty
        $submissions = Submission::whereIn(
            'assignment_id',
            Assignment::whereIn('section_id', $sections)->pluck('assignment_id')
        )->count();

        // Exams via sections
        $exams = Exam::whereIn('section_id', $sections)->count();

        return view('faculty.dashboard', compact(
            'courses',
            'sections',
            'assignments',
            'submissions',
            'announcements',
            'exams'
        ));
    }
}
