<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Course;
use App\Models\Term;
use App\Models\Room;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class SectionController extends Controller
{
    public function index()
    {
        $facultyId = Session::get('user_id');

        $sections = Section::where('faculty_id', $facultyId)
            ->with(['course', 'term', 'room'])
            ->get();

        return view('faculty.sections.index', compact('sections'));
    }

    public function create()
    {
        $facultyId = Session::get('user_id');

        // Only show courses assigned to this faculty
        $courses = Course::where('faculty_id', $facultyId)->get();
        $terms = Term::all();
        $rooms = Room::all();

        return view('faculty.sections.create', compact('courses', 'terms', 'rooms'));
    }

    public function store(Request $request)
    {
        $facultyId = Session::get('user_id');

        $request->validate([
            'course_id'     => 'required|exists:AR8974_COURSE,course_id',
            'term_id'       => 'required|exists:AR8974_TERM,term_id',
            'schedule_day'  => 'required|string',
            'start_time'    => 'required|date_format:H:i',
            'end_time'      => 'required|date_format:H:i|after:start_time',
            'room_id'       => 'required|exists:AR8974_ROOM,room_id',
            'capacity'      => 'required|integer|min:1',
        ]);

        Section::create(array_merge($request->all(), ['faculty_id' => $facultyId]));

        return redirect()->route('faculty.sections.index')->with('success', 'Section created successfully.');
    }

    public function edit(Section $section)
    {
        $facultyId = Session::get('user_id');

        $courses = Course::where('faculty_id', $facultyId)->get();
        $terms = Term::all();
        $rooms = Room::all();

        return view('faculty.sections.create', compact('section', 'courses', 'terms', 'rooms'));
    }

    public function update(Request $request, Section $section)
    {

        $request->validate([
        'course_id'     => 'required|exists:AR8974_COURSE,course_id',
        'term_id'       => 'required|exists:AR8974_TERM,term_id',
        'schedule_day'  => 'required|string',
        'room_id'       => 'required|exists:AR8974_ROOM,room_id',
        'capacity'      => 'required|integer|min:1',
        ]);

        $section->update($request->all());

        return redirect()->route('faculty.sections.index')->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return back()->with('success', 'Section deleted successfully.');
    }
}
