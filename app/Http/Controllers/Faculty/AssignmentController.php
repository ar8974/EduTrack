<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Section;
use Illuminate\Support\Facades\Session;

class AssignmentController extends Controller
{
    public function index()
    {
        $facultyId = Session::get('user_id');
        $sections = Section::where('faculty_id', $facultyId)->pluck('section_id');
        $assignments = Assignment::whereIn('section_id', $sections)->get();
        return view('faculty.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $sections = Section::where('faculty_id', Session::get('user_id'))->get();
        return view('faculty.assignments.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_id'=>'required',
            'title'=>'required',
            'description'=>'required',
            'due_date'=>'required|date',
        ]);

        Assignment::create(array_merge($request->all(), ['posted_by'=>Session::get('user_id')]));
        return redirect()->route('faculty.assignments.index')->with('success','Assignment created.');
    }

    public function edit(Assignment $assignment)
    {
        $sections = Section::where('faculty_id', Session::get('user_id'))->get();
        return view('faculty.assignments.create', compact('assignment','sections'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $assignment->update($request->all());
        return redirect()->route('faculty.assignments.index')->with('success','Assignment updated.');
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        return back()->with('success','Assignment deleted.');
    }
}
