<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rubric;
use App\Models\Assignment;
use Illuminate\Support\Facades\Session;

class RubricController extends Controller
{
    public function index()
    {
        $facultyId = Session::get('user_id');
        $assignments = Assignment::where('posted_by', $facultyId)->pluck('assignment_id');
        $rubrics = Rubric::whereIn('assignment_id', $assignments)->get();
        return view('faculty.rubrics.index', compact('rubrics'));
    }

    public function create()
    {
        $assignments = Assignment::where('posted_by', Session::get('user_id'))->get();
        return view('faculty.rubrics.create', compact('assignments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'assignment_id'=>'required',
            'criterion'=>'required',
            'max_score'=>'required|numeric',
        ]);

        Rubric::create($request->all());
        return redirect()->route('faculty.rubrics.index')->with('success','Rubric added.');
    }

    public function edit(Rubric $rubric)
    {
        $assignments = Assignment::where('posted_by', Session::get('user_id'))->get();
        return view('faculty.rubrics.create', compact('rubric','assignments'));
    }

    public function update(Request $request, Rubric $rubric)
    {
        $rubric->update($request->all());
        return redirect()->route('faculty.rubrics.index')->with('success','Rubric updated.');
    }

    public function destroy(Rubric $rubric)
    {
        $rubric->delete();
        return back()->with('success','Rubric deleted.');
    }
}
