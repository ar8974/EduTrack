<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // List all departments
    public function index()
    {
        $departments = Department::orderBy('dept_name')->get();
        return view('departments.index', compact('departments'));
    }

    // Show create form
    public function create()
    {
        return view('departments.create');
    }

    // Store new department
    public function store(Request $request)
    {
        $data = $request->validate([
            'dept_name'   => 'required|string|max:100',
            'description' => 'nullable|string|max:250',
        ]);

        Department::create($data);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    // Show edit form
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    // Update existing department
    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'dept_name'   => 'required|string|max:100',
            'description' => 'nullable|string|max:250',
        ]);

        $department->update($data);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    // Delete a department
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
