<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Session;

class AnnouncementController extends Controller
{
    public function index()
    {
        $studentId = Session::get('user_id');
        $sectionIds = Enrollment::where('student_id', $studentId)->pluck('section_id');

        $announcements = Announcement::whereIn('section_id', $sectionIds)
            ->with(['section.course'])
            ->orderBy('posted_on', 'desc')
            ->get();

        return view('student.announcements.index', compact('announcements'));
    }
}
