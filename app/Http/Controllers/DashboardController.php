<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Announcement;
use App\Models\Message;
use App\Models\Department;
use App\Models\DiscussionThread;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            // Basic Counts from MySQL
            'userCount' => User::count(),
            'courseCount' => Course::count(),
            'assignmentCount' => Assignment::count(),
            'submissionCount' => Submission::count(),

            // Latest records from MySQL
            'recentAnnouncements' => Announcement::orderBy('posted_on','desc')->limit(5)->get(),
            'recentAssignments' => Assignment::orderBy('due_date','desc')->limit(5)->get(),
            'recentSubmissions' => Submission::orderBy('submitted_on','desc')->limit(5)->get(),
            'recentMessages' => Message::orderBy('sent_on','desc')->limit(5)->get(),
            'recentThreads' => DiscussionThread::orderBy('created_on','desc')->limit(5)->get(),
        ]);
    }
}
