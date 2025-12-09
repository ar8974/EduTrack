<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Course;
use App\Models\Section;
use App\Models\Assignment;
use App\Models\Exam;
use App\Models\Submission;
use App\Models\DiscussionThread;
use App\Models\Announcement;
use App\Models\Message;

use App\Http\Controllers\Controller;

class FacultyController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::get('logged_in') || Session::get('role') !== 'FACULTY') {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $facultyId = Session::get('user_id');

        $courseCount = Course::where('faculty_id', $facultyId)->count();
        $sectionCount = Section::where('faculty_id', $facultyId)->count();
        $assignmentCount = Assignment::where('posted_by', $facultyId)->count();
        $examCount = Exam::whereIn('section_id', Section::where('faculty_id', $facultyId)->pluck('section_id'))->count();
        $submissionCount = Submission::whereIn('assignment_id', Assignment::where('posted_by', $facultyId)->pluck('assignment_id'))->count();
        $announcementCount = Announcement::where('posted_by', $facultyId)->count();
        $messageCount = Message::where('receiver_id', $facultyId)->count();
        $discussionCount = DiscussionThread::where('created_by', $facultyId)->count();

        return view('faculty.dashboard', compact(
            'courseCount','sectionCount','assignmentCount','examCount',
            'submissionCount','announcementCount','messageCount','discussionCount'
        ));
    }
}
