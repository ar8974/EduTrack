<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Models\Enrollment;
use App\Models\Section;

class EnrollmentController extends Controller
{
    public function index()
    {
        $studentId = Session::get('user_id');
        $enrollments = Enrollment::where('student_id', $studentId)->with(['section.course', 'section.faculty'])->get();

        return view('student.enrollments.index', compact('enrollments'));
    }


    public function create()
    {
        $studentId = Session::get('user_id');
        $currentSections = Enrollment::where('student_id', $studentId)->pluck('section_id');

        $sections = Section::whereNotIn('section_id', $currentSections)->with(['course', 'faculty', 'term'])->get();

        return view('student.enrollments.create', compact('sections'));
    }


    public function store()
    {
        $studentId = Session::get('user_id');

        request()->validate([
            'section_id' => 'required|exists:AR8974_SECTION,section_id'
        ]);

        if (Enrollment::where('student_id', $studentId)
                      ->where('section_id', request('section_id'))
                      ->exists()) 
        {
            return back()->with('error', 'You are already enrolled in this section.');
        }

        Enrollment::create([
            'student_id' => $studentId,
            'section_id' => request('section_id'),
            'enrolled_on' => now(),
        ]);

        return redirect()->route('student.enrollments.index')
                         ->with('success', 'Enrolled successfully.');
    }


    public function drop($id)
    {
        $studentId = Session::get('user_id');
        $enrollment = Enrollment::where('enrollment_id', $id)->where('student_id', $studentId)->firstOrFail();

        $enrollment->delete();

        return redirect()->route('student.enrollments.index')
                         ->with('success', 'You dropped the course.');
    }
}
