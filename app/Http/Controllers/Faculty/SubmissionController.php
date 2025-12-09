<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Assignment;
use Illuminate\Support\Facades\Session;

class SubmissionController extends Controller
{
    public function index()
    {
        $facultyId = Session::get('user_id');

        $assignments = Assignment::whereHas('section', function ($q) use ($facultyId) {
            $q->where('faculty_id', $facultyId);
        })->pluck('assignment_id');

        $submissions = Submission::whereIn('assignment_id', $assignments)
            ->with(['student', 'assignment'])
            ->get();

        return view('faculty.submissions.index', compact('submissions'));
    }

    public function show(Submission $submission)
    {
        return view('faculty.submissions.show', compact('submission'));
    }

    public function edit(Submission $submission)
    {
        return view('faculty.submissions.edit', compact('submission'));
    }

    public function update(Request $request, Submission $submission)
    {
        $request->validate([
            'grade'    => 'required|numeric',
            'feedback' => 'nullable|string',
        ]);

        $submission->grade = $request->input('grade');
        $submission->feedback = $request->input('feedback');
        $submission->graded_by = Session::get('user_id');
        $submission->save();

        return redirect()->route('faculty.submissions.index')
            ->with('success', 'Submission graded successfully.');
    }
}