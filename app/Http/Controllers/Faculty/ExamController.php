<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Section;
use Illuminate\Support\Facades\Session;

class ExamController extends Controller
{
    public function index()
    {
        $facultyId = Session::get('user_id');
        $sections = Section::where('faculty_id', $facultyId)->pluck('section_id');
        $exams = Exam::whereIn('section_id', $sections)->get();
        return view('faculty.exams.index', compact('exams'));
    }

    public function create()
    {
        $sections = Section::where('faculty_id', Session::get('user_id'))->get();
        return view('faculty.exams.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_id'=>'required',
            'title'=>'required',
            'exam_date'=>'required|date',
            'duration_minutes'=>'required|integer',
        ]);

        Exam::create(array_merge($request->all()));
        return redirect()->route('faculty.exams.index')->with('success','Exam scheduled.');
    }

    public function edit(Exam $exam)
    {
        $sections = Section::where('faculty_id', Session::get('user_id'))->get();
        return view('faculty.exams.create', compact('exam','sections'));
    }

    public function update(Request $request, Exam $exam)
    {
        $exam->update($request->all());
        return redirect()->route('faculty.exams.index')->with('success','Exam updated.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return back()->with('success','Exam deleted.');
    }
}
