<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    public function index()
    {
        $facultyId = Session::get('user_id');

        // Only courses assigned to this faculty
        $courses = Course::where('faculty_id', $facultyId)
            ->with('department')
            ->get();

        return view('faculty.courses.index', compact('courses'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('faculty.courses.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $facultyId = Session::get('user_id');

        $request->validate([
            'course_code'    => 'required',
            'course_name'    => 'required',
            'description'    => 'nullable',
            'dept_id'  => 'required|exists:AR8974_DEPARTMENT,dept_id',
            'credits'        => 'required|integer|min:0',
        ]);

        Course::create(array_merge($request->all(), ['faculty_id' => $facultyId]));

        return redirect()->route('faculty.courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $departments = Department::all();
        return view('faculty.courses.create', compact('course', 'departments'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_code'    => 'required',
            'course_name'    => 'required',
            'description'    => 'nullable',
            'dept_id'  => 'required|exists:AR8974_DEPARTMENT,dept_id',
            'credits'        => 'required|integer|min:0',
        ]);

        $course->update($request->all());

        return redirect()->route('faculty.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course deleted successfully.');
    }
}
