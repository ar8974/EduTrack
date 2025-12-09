<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Models\Exam;
use App\Models\Enrollment;
use Carbon\Carbon;

class ExamController extends Controller
{
    public function index()
    {
        $studentId = Session::get('user_id');

        $sectionIds = Enrollment::where('student_id', $studentId)->pluck('section_id');

        $exams = Exam::whereIn('section_id', $sectionIds)
            ->with(['section.course'])
            ->orderBy('exam_date', 'asc')
            ->orderBy('exam_id', 'asc')
            ->get();

        return view('student.exams.index', compact('exams'));
    }

    public function show(Exam $exam)
    {
        return view('student.exams.show', compact('exam'));
    }
}
