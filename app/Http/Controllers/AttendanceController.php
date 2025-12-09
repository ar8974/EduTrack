<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index() {
        $attendances = Attendance::with('section', 'student', 'markedBy')->get();
        return view('attendance.index', compact('attendances'));
    }

    public function create() {
        $sections = Section::all();
        $students = User::whereHas('role', fn($q) => $q->where('role_name', 'Student'))->get();
        return view('attendance.create', compact('sections', 'students'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'section_id' => 'required|integer',
            'student_id' => 'required|integer',
            'attendance_date' => 'required|date',
            'status' => 'required|in:Present,Absent,Late',
            'marked_by' => 'required|integer'
        ]);

        Attendance::create($data);
        return redirect()->route('attendance.index')->with('success', 'Attendance recorded.');
    }

    public function destroy(Attendance $attendance) {
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Attendance deleted.');
    }
}
