<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('department')->orderBy('course_id','desc')->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('courses.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_code' => 'required|string|max:20|unique:AR8974_COURSE,course_code',
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'dept_id'     => 'required|integer|exists:AR8974_DEPARTMENT,dept_id',
            'credits'     => 'required|integer|min:0',
        ]);

        Course::create($data);

        return redirect()->route('courses.index')->with('success','Course created successfully.');
    }

    public function edit(Course $course)
    {
        $departments = Department::all();
        return view('courses.edit', compact('course','departments'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'course_code' => 'required|string|max:20|unique:AR8974_COURSE,course_code,' . $course->course_id . ',course_id',
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'dept_id'     => 'required|integer|exists:AR8974_DEPARTMENT,dept_id',
            'credits'     => 'required|integer|min:0',
        ]);

        $course->update($data);

        return redirect()->route('courses.index')->with('success','Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success','Course deleted.');
    }
}
