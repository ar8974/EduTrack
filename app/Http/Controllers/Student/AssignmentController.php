<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Section;
use App\Models\Submission;

class AssignmentController extends Controller
{
    public function index()
    {
        $studentId = Session::get('user_id');

        $sectionIds = Section::whereHas('enrollments', function ($q) use ($studentId) {
            $q->where('student_id', $studentId);
        })->pluck('section_id');

        $assignments = Assignment::whereIn('section_id', $sectionIds)->with('section.course')->orderBy('due_date')->get();

        return view('student.assignments.index', compact('assignments'));
    }

    public function create($assignmentId)
    {
        $studentId = Session::get('user_id');

        $assignment = Assignment::with('section.course')->where('assignment_id', $assignmentId)->firstOrFail();

        $isEnrolled = $assignment->section
            ->enrollments
            ->where('student_id', $studentId)
            ->count() > 0;

        if (! $isEnrolled) {
            abort(403, 'You are not enrolled in this section.');
        }

        return view('student.assignments.create', compact('assignment'));
    }

    public function store(Request $request, $assignmentId)
    {
        $studentId = Session::get('user_id');

        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg|max:20480'
        ]);

        $path = $request->file('file')->store('submissions', 'public');

        Submission::create([
            'assignment_id' => $assignmentId,
            'student_id' => $studentId,
            'submitted_on' => now(),
            'file_path' => $path,
            'grade' => null,
            'feedback' => null,
            'graded_by' => null,
        ]);

        return redirect()
            ->route('student.submissions.index')
            ->with('success', 'Assignment submitted successfully.');
    }
}
