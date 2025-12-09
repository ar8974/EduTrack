<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Exam;
use App\Models\Section;
use Carbon\Carbon;

class ExamController extends Controller
{
    // List exams for current faculty (via sections)
    public function index()
    {
        $facultyId = Session::get('user_id');

        $exams = Exam::whereHas('section', function ($q) use ($facultyId) {
                $q->where('faculty_id', $facultyId);
            })
            ->with(['section.course'])
            ->get();

        return view('faculty.exams.index', compact('exams'));
    }

    // Show create form
    public function create()
    {
        $facultyId = Session::get('user_id');

        // sections taught by this faculty
        $sections = Section::where('faculty_id', $facultyId)->with('course')->get();

        return view('faculty.exams.create', compact('sections'));
    }

    // Store new exam
    public function store(Request $request)
    {
        $facultyId = Session::get('user_id');

        $request->validate([
            'section_id' => 'required|exists:AR8974_SECTION,section_id',
            'title' => 'required|string|max:255',
            'exam_date' => 'required|date', // expects a parseable date/time
            'duration_minutes' => 'required|integer|min:1',
        ]);

        // ensure the section belongs to this faculty
        $section = Section::where('section_id', $request->section_id)
            ->where('faculty_id', $facultyId)
            ->firstOrFail();

        // Normalize exam_date to DB-friendly datetime
        $examDate = Carbon::parse($request->exam_date)->toDateTimeString();

        Exam::create([
            'section_id' => $request->section_id,
            'title' => $request->title,
            'exam_date' => $examDate,
            'duration_minutes' => $request->duration_minutes,
        ]);

        return redirect()->route('faculty.exams.index')->with('success', 'Exam created.');
    }

    // Show edit form
    public function edit(Exam $exam)
    {
        $facultyId = Session::get('user_id');

        // ownership check: section must belong to this faculty
        if (!$exam->section || $exam->section->faculty_id != $facultyId) {
            abort(403, 'Unauthorized');
        }

        $sections = Section::where('faculty_id', $facultyId)->with('course')->get();

        return view('faculty.exams.create', compact('exam', 'sections'));
    }

    // Update exam
    public function update(Request $request, Exam $exam)
    {
        $facultyId = Session::get('user_id');

        if (!$exam->section || $exam->section->faculty_id != $facultyId) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'section_id' => 'required|exists:AR8974_SECTION,section_id',
            'title' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        // ensure the (possibly new) section belongs to this faculty
        $section = Section::where('section_id', $request->section_id)
            ->where('faculty_id', $facultyId)
            ->firstOrFail();

        $examDate = Carbon::parse($request->exam_date)->toDateTimeString();

        $exam->update([
            'section_id' => $request->section_id,
            'title' => $request->title,
            'exam_date' => $examDate,
            'duration_minutes' => $request->duration_minutes,
        ]);

        return redirect()->route('faculty.exams.index')->with('success', 'Exam updated.');
    }

    // Delete exam
    public function destroy(Exam $exam)
    {
        $facultyId = Session::get('user_id');

        if (!$exam->section || $exam->section->faculty_id != $facultyId) {
            abort(403, 'Unauthorized');
        }

        $exam->delete();
        return back()->with('success', 'Exam deleted.');
    }
}
