<?php

namespace App\Http\Controllers;

use App\Models\Rubric;
use App\Models\Assignment;
use Illuminate\Http\Request;

class RubricController extends Controller
{
    // List all rubrics
    public function index()
    {
        $rubrics = Rubric::with('assignment')->orderBy('rubric_id', 'desc')->get();
        return view('rubrics.index', compact('rubrics'));
    }

    // Show form to create a rubric
    public function create()
    {
        $assignments = Assignment::all();
        return view('rubrics.form', compact('assignments'));
    }

    // Store a new rubric
    public function store(Request $request)
    {
        $data = $request->validate([
            'assignment_id' => 'required|integer|exists:AR8974_ASSIGNMENT,assignment_id',
            'criterion'     => 'required|string|max:255',
            'max_score'     => 'required|numeric',
        ]);

        Rubric::create($data);
        return redirect()->route('rubrics.index')->with('success', 'Rubric created successfully.');
    }

    // Show edit form
    public function edit(Rubric $rubric)
    {
        $assignments = Assignment::all();
        return view('rubrics.form', compact('rubric', 'assignments'));
    }

    // Update rubric
    public function update(Request $request, Rubric $rubric)
    {
        $data = $request->validate([
            'assignment_id' => 'required|integer|exists:AR8974_ASSIGNMENT,assignment_id',
            'criterion'     => 'required|string|max:255',
            'max_score'     => 'required|numeric',
        ]);

        $rubric->update($data);
        return redirect()->route('rubrics.index')->with('success', 'Rubric updated successfully.');
    }

    // Delete rubric
    public function destroy(Rubric $rubric)
    {
        $rubric->delete();
        return redirect()->route('rubrics.index')->with('success', 'Rubric deleted successfully.');
    }
}
