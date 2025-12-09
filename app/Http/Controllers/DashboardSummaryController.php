<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardSummaryController extends Controller
{
    public function summary()
    {
        // Counts
        $studentCount = DB::connection('dw_sqlite')->table('dim_student')->count();
        $facultyCount = DB::connection('dw_sqlite')->table('dim_faculty')->count();
        $courseCount  = DB::connection('dw_sqlite')->table('dim_course')->count();

        // Enrollment per course
        $enrollmentData = DB::connection('dw_sqlite')
            ->table('fact_enrollment')
            ->select('course_key', DB::raw('COUNT(*) as total'))
            ->groupBy('course_key')
            ->limit(10)
            ->get();

        // Enrollment trend (by effective date)
        $enrollmentTrend = DB::connection('dw_sqlite')
            ->table('fact_enrollment')
            ->select(DB::raw('DATE(enrollment_date) as day'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('DATE(enrollment_date)'))
            ->orderBy('day')
            ->get();

        // Attendance status breakdown
        $attendanceData = DB::connection('dw_sqlite')
            ->table('fact_attendance')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        // Attendance by day (heatmap style)
        $attendanceByDay = DB::connection('dw_sqlite')
            ->table('fact_attendance')
            ->select(DB::raw('DATE(attendance_date) as day'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('DATE(attendance_date)'))
            ->get();

        // Grade distribution (horizontal)
        $gradeData = DB::connection('dw_sqlite')
            ->table('fact_grade')
            ->select('grade', DB::raw('COUNT(*) as total'))
            ->groupBy('grade')
            ->orderBy('grade')
            ->get();

        // Average grade per course
        $avgGrade = DB::connection('dw_sqlite')
            ->table('fact_grade')
            ->select('course_key', DB::raw('AVG(grade_points) as average'))
            ->groupBy('course_key')
            ->get();

        // Submission counts per course
        $submissionCounts = DB::connection('dw_sqlite')
            ->table('fact_assignment_submission')
            ->select('course_key', DB::raw('COUNT(*) as total'))
            ->groupBy('course_key')
            ->get();

        return view('dashboard.summary', compact(
            'studentCount', 'facultyCount', 'courseCount',
            'enrollmentData', 'attendanceData', 'gradeData',
            'avgGrade', 'submissionCounts', 'enrollmentTrend', 'attendanceByDay'
        ));
    }
}
