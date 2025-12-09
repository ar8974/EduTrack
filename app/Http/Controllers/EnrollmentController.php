<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('section.course','student')->orderBy('enrollment_id','desc')->get();
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $sections = Section::all();
        $students = User::where('role_id', 3)->get(); // assuming role_id=3 is student
        return view('enrollments.create', compact('sections','students'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section_id'  => 'required|integer|exists:AR8974_SECTION,section_id',
            'student_id'  => 'required|integer|exists:AR8974_USER,user_id',
            'enrolled_on' => 'required|date',
            'final_grade' => 'nullable|numeric|min:0|max:100',
        ]);

        Enrollment::create($data);

        return redirect()->route('enrollments.index')->with('success','Enrollment created successfully.');
    }

    public function edit(Enrollment $enrollment)
    {
        $sections = Section::all();
        $students = User::where('role_id', 3)->get();
        return view('enrollments.edit', compact('enrollment','sections','students'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $data = $request->validate([
            'section_id'  => 'required|integer|exists:AR8974_SECTION,section_id',
            'student_id'  => 'required|integer|exists:AR8974_USER,user_id',
            'enrolled_on' => 'required|date',
            'final_grade' => 'nullable|numeric|min:0|max:100',
        ]);

        $enrollment->update($data);

        return redirect()->route('enrollments.index')->with('success','Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success','Enrollment deleted.');
    }
}
