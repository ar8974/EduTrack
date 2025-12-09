<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    // List all submissions
    public function index()
    {
        $submissions = Submission::with(['assignment', 'student', 'grader'])->orderBy('submitted_on', 'desc')->get();
        return view('submissions.index', compact('submissions'));
    }

    // Show create form
    public function create()
    {
        $assignments = Assignment::all();
        $students = User::all();
        $graders = User::all();
        return view('submissions.form', compact('assignments', 'students', 'graders'));
    }

    // Store a new submission
    public function store(Request $request)
    {
        $data = $request->validate([
            'assignment_id' => 'required|integer|exists:AR8974_ASSIGNMENT,assignment_id',
            'student_id'    => 'required|integer|exists:AR8974_USER,user_id',
            'submitted_on'  => 'nullable|date',
            'file_path'     => 'nullable|string|max:255',
            'grade'         => 'nullable|numeric',
            'feedback'      => 'nullable|string',
            'graded_by'     => 'nullable|integer|exists:AR8974_USER,user_id',
        ]);

        Submission::create($data);

        return redirect()->route('submissions.index')->with('success', 'Submission created successfully.');
    }

    // Show edit form
    public function edit(Submission $submission)
    {
        $assignments = Assignment::all();
        $students = User::all();
        $graders = User::all();
        return view('submissions.form', compact('submission', 'assignments', 'students', 'graders'));
    }

    // Update submission
    public function update(Request $request, Submission $submission)
    {
        $data = $request->validate([
            'assignment_id' => 'required|integer|exists:AR8974_ASSIGNMENT,assignment_id',
            'student_id'    => 'required|integer|exists:AR8974_USER,user_id',
            'submitted_on'  => 'nullable|date',
            'file_path'     => 'nullable|string|max:255',
            'grade'         => 'nullable|numeric',
            'feedback'      => 'nullable|string',
            'graded_by'     => 'nullable|integer|exists:AR8974_USER,user_id',
        ]);

        $submission->update($data);

        return redirect()->route('submissions.index')->with('success', 'Submission updated successfully.');
    }

    // Delete submission
    public function destroy(Submission $submission)
    {
        $submission->delete();
        return redirect()->route('submissions.index')->with('success', 'Submission deleted successfully.');
    }
}
