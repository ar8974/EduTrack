<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Section;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('section')->orderBy('assignment_id','desc')->get();
        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('assignments.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section_id'    => 'required|integer|exists:AR8974_SECTION,section_id',
            'title'         => 'required|string|max:200',
            'description'   => 'nullable|string',
            'due_date'      => 'required|date',
            'total_points'  => 'required|numeric|min:0',
            'is_team_based' => 'nullable|boolean',
        ]);

        $data['is_team_based'] = $request->has('is_team_based') ? 1 : 0;

        Assignment::create($data);

        return redirect()->route('assignments.index')->with('success','Assignment created successfully.');
    }

    public function edit(Assignment $assignment)
    {
        $sections = Section::all();
        return view('assignments.edit', compact('assignment','sections'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $data = $request->validate([
            'section_id'    => 'required|integer|exists:AR8974_SECTION,section_id',
            'title'         => 'required|string|max:200',
            'description'   => 'nullable|string',
            'due_date'      => 'required|date',
            'total_points'  => 'required|numeric|min:0',
            'is_team_based' => 'nullable|boolean',
        ]);

        $data['is_team_based'] = $request->has('is_team_based') ? 1 : 0;

        $assignment->update($data);

        return redirect()->route('assignments.index')->with('success','Assignment updated successfully.');
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        return redirect()->route('assignments.index')->with('success','Assignment deleted.');
    }
}
