<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Submission;
use App\Models\Assignment;

class SubmissionController extends Controller
{
    public function index()
    {
        $studentId = Session::get('user_id');

        $submissions = Submission::where('student_id', $studentId)
            ->with('assignment.section.course')
            ->orderBy('submitted_on', 'desc')
            ->get();

        return view('student.submissions.index', compact('submissions'));
    }

    public function create($assignmentId)
    {
        $assignment = Assignment::with('section.course')->findOrFail($assignmentId);

        return view('student.submissions.create', compact('assignment'));
    }

    public function store(Request $request)
    {
        $studentId = Session::get('user_id');

        $request->validate([
            'assignment_id' => 'required|exists:AR8974_ASSIGNMENT,assignment_id',
            'file' => 'required|file|max:10240',
        ]);

        $filePath = $request->file('file')->store('submissions');

        Submission::create([
            'assignment_id' => $request->assignment_id,
            'student_id' => $studentId,
            'submitted_on' => now(),
            'file_path' => $filePath,
        ]);

        return redirect()->route('student.submissions.index')
            ->with('success', 'Assignment submitted successfully.');
    }

    public function show(Submission $submission)
    {
        $submission->load('assignment.section.course');

        if (!$submission->assignment) {
            abort(404, 'Assignment not found for this submission.');
        }

        return view('student.submissions.show', compact('submission'));
    }
}

