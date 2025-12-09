<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Course;
use App\Models\Term;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('course', 'term', 'faculty', 'room')->orderBy('section_id','desc')->get();
        return view('sections.index', compact('sections'));
    }

    public function create()
    {
        $courses = Course::all();
        $terms = Term::all();
        $faculty = User::where('role_id', 2)->get(); // assuming role_id=2 is faculty
        $rooms = Room::all();
        return view('sections.create', compact('courses','terms','faculty','rooms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id'    => 'required|integer|exists:AR8974_COURSE,course_id',
            'term_id'      => 'required|integer|exists:AR8974_TERM,term_id',
            'faculty_id'   => 'required|integer|exists:AR8974_USER,user_id',
            'schedule_day' => 'required|string|max:10',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'room_id'      => 'required|integer|exists:AR8974_ROOM,room_id',
            'capacity'     => 'required|integer|min:1',
        ]);

        Section::create($data);

        return redirect()->route('sections.index')->with('success','Section created successfully.');
    }

    public function edit(Section $section)
    {
        $courses = Course::all();
        $terms = Term::all();
        $faculty = User::where('role_id', 2)->get(); // faculty
        $rooms = Room::all();

        return view('sections.edit', compact('section','courses','terms','faculty','rooms'));
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'course_id'    => 'required|integer|exists:AR8974_COURSE,course_id',
            'term_id'      => 'required|integer|exists:AR8974_TERM,term_id',
            'faculty_id'   => 'required|integer|exists:AR8974_USER,user_id',
            'schedule_day' => 'required|string|max:10',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'room_id'      => 'required|integer|exists:AR8974_ROOM,room_id',
            'capacity'     => 'required|integer|min:1',
        ]);

        $section->update($data);

        return redirect()->route('sections.index')->with('success','Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success','Section deleted.');
    }
}
