<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncDW extends Command
{
    protected $signature = 'sync:dw';
    protected $description = 'Incrementally sync OLTP MySQL data into SQLite Data Warehouse';

    public function handle()
    {
        $this->info("=== Starting DW Sync ===");
        $this->syncStudents();
        $this->syncFaculty();
        $this->syncCourses();
        $this->syncEnrollment();
        $this->syncAttendance();
        $this->syncGrades();
        $this->syncAssignmentSubmissions();
        $this->info("=== DW Sync Completed Successfully ===");
    }

    protected function getLastSync($table)
    {
        $last = DB::connection('dw_sqlite')
            ->table($table)
            ->max('effective_dt');

        return $last ?: '1900-01-01 00:00:00';
    }

    protected function syncStudents()
    {
        $lastSync = $this->getLastSync('dim_student');

        $students = DB::connection('mysql')
            ->table('AR8974_USER as u')
            ->leftJoin('AR8974_DEPARTMENT as d', 'u.dept_id', '=', 'd.dept_id')
            ->where('u.role_id', 2)
            ->where('u.tbl_last_dt', '>', $lastSync)
            ->select(
                'u.user_id',
                'u.first_name',
                'u.last_name',
                'u.email',
                'd.dept_name',
                'u.tbl_last_dt'
            )
            ->get();

        foreach ($students as $s) {
            DB::connection('dw_sqlite')->table('dim_student')->updateOrInsert(
                ['student_key' => $s->user_id],
                [
                    'student_id' => $s->user_id,
                    'first_name' => $s->first_name,
                    'last_name' => $s->last_name,
                    'email' => $s->email,
                    'department_name' => $s->dept_name,
                    'effective_dt' => $s->tbl_last_dt,
                    'record_active' => 'Y',
                ]
            );
        }

        $this->info("DIM_STUDENT synced.");
    }

    protected function syncFaculty()
    {
        $lastSync = $this->getLastSync('dim_faculty');

        $faculty = DB::connection('mysql')
            ->table('AR8974_USER as u')
            ->leftJoin('AR8974_DEPARTMENT as d', 'u.dept_id', '=', 'd.dept_id')
            ->where('u.role_id', 1)
            ->where('u.tbl_last_dt', '>', $lastSync)
            ->select(
                'u.user_id',
                'u.first_name',
                'u.last_name',
                'u.email',
                'd.dept_name',
                'u.tbl_last_dt'
            )
            ->get();

        foreach ($faculty as $f) {
            DB::connection('dw_sqlite')->table('dim_faculty')->updateOrInsert(
                ['faculty_key' => $f->user_id],
                [
                    'faculty_id' => $f->user_id,
                    'first_name' => $f->first_name,
                    'last_name' => $f->last_name,
                    'department_name' => $f->dept_name,
                    'email' => $f->email,
                    'effective_dt' => $f->tbl_last_dt,
                ]
            );
        }

        $this->info("DIM_FACULTY synced.");
    }

    protected function syncCourses()
    {
        $lastSync = $this->getLastSync('dim_course');

        $courses = DB::connection('mysql')
            ->table('AR8974_COURSE as c')
            ->leftJoin('AR8974_DEPARTMENT as d', 'c.dept_id', '=', 'd.dept_id')
            ->leftJoin('AR8974_SECTION as s', 'c.course_id', '=', 's.course_id')
            ->leftJoin('AR8974_TERM as t', 's.term_id', '=', 't.term_id')
            ->where('c.tbl_last_dt', '>', $lastSync)
            ->select(
                'c.course_id',
                'c.course_code',
                'c.course_name',
                'd.dept_name',
                't.term_name',
                's.faculty_id',
                'c.tbl_last_dt'
            )
            ->get();

        foreach ($courses as $c) {
            DB::connection('dw_sqlite')->table('dim_course')->updateOrInsert(
                ['course_key' => $c->course_id],
                [
                    'course_id' => $c->course_id,
                    'course_code' => $c->course_code,
                    'course_name' => $c->course_name,
                    'department_name' => $c->dept_name,
                    'term_name' => $c->term_name,
                    'faculty_id' => $c->faculty_id,
                    'effective_dt' => $c->tbl_last_dt,
                    'record_active' => 'Y',
                ]
            );
        }

        $this->info("DIM_COURSE synced.");
    }

    protected function syncEnrollment()
    {
        $lastSync = $this->getLastSync('fact_enrollment');

        $enroll = DB::connection('mysql')
            ->table('AR8974_ENROLLMENT as e')
            ->leftJoin('AR8974_SECTION as s', 'e.section_id', '=', 's.section_id')
            ->where('e.tbl_last_dt', '>', $lastSync)
            ->select(
                'e.enrollment_id',
                'e.student_id',
                's.course_id',
                'e.enrolled_on',
                'e.final_grade',
                'e.tbl_last_dt'
            )
            ->get();

        foreach ($enroll as $e) {
            DB::connection('dw_sqlite')->table('fact_enrollment')->updateOrInsert(
                ['enrollment_key' => $e->enrollment_id],
                [
                    'student_key' => $e->student_id,
                    'course_key' => $e->course_id,
                    'enrollment_date' => $e->enrolled_on,
                    'status' => $e->final_grade ? 'Completed' : 'Enrolled',
                    'course_id' => $e->course_id,
                    'effective_dt' => $e->tbl_last_dt,
                ]
            );
        }

        $this->info("FACT_ENROLLMENT synced.");
    }

    protected function syncAttendance()
    {
        $lastSync = $this->getLastSync('fact_attendance');

        $att = DB::connection('mysql')
            ->table('AR8974_ATTENDANCE as a')
            ->leftJoin('AR8974_SECTION as s', 'a.section_id', '=', 's.section_id')
            ->where('a.tbl_last_dt', '>', $lastSync)
            ->select(
                'a.attendance_id',
                'a.student_id',
                's.course_id',
                'a.attendance_date',
                'a.status',
                'a.tbl_last_dt'
            )
            ->get();

        foreach ($att as $a) {
            DB::connection('dw_sqlite')->table('fact_attendance')->updateOrInsert(
                ['attendance_key' => $a->attendance_id],
                [
                    'student_key' => $a->student_id,
                    'course_key' => $a->course_id,
                    'attendance_date' => $a->attendance_date,
                    'status' => $a->status,
                    'effective_dt' => $a->tbl_last_dt,
                ]
            );
        }

        $this->info("FACT_ATTENDANCE synced.");
    }

    protected function syncGrades()
    {
        $lastSync = $this->getLastSync('fact_grade');

        $grades = DB::connection('mysql')
            ->table('AR8974_ENROLLMENT as e')
            ->leftJoin('AR8974_SECTION as s', 'e.section_id', '=', 's.section_id')
            ->leftJoin('AR8974_TERM as t', 's.term_id', '=', 't.term_id')
            ->where('e.tbl_last_dt', '>', $lastSync)
            ->select(
                'e.enrollment_id',
                'e.student_id',
                's.course_id',
                'e.final_grade',
                't.term_name',
                'e.tbl_last_dt'
            )
            ->get();

        foreach ($grades as $g) {
            DB::connection('dw_sqlite')->table('fact_grade')->updateOrInsert(
                ['grade_key' => $g->enrollment_id],
                [
                    'student_key' => $g->student_id,
                    'course_key' => $g->course_id,
                    'grade' => $g->final_grade,
                    'grade_points' => $g->final_grade,
                    'term_name' => $g->term_name,
                    'effective_dt' => $g->tbl_last_dt,
                ]
            );
        }

        $this->info("FACT_GRADE synced.");
    }

    protected function syncAssignmentSubmissions()
    {
        $lastSync = $this->getLastSync('fact_assignment_submission');

        $subs = DB::connection('mysql')
            ->table('AR8974_SUBMISSION as s')
            ->leftJoin('AR8974_ASSIGNMENT as a', 's.assignment_id', '=', 'a.assignment_id')
            ->leftJoin('AR8974_SECTION as sec', 'a.section_id', '=', 'sec.section_id')
            ->where('s.tbl_last_dt', '>', $lastSync)
            ->select(
                's.submission_id',
                's.student_id',
                'sec.course_id',
                's.assignment_id',
                's.grade',
                's.submitted_on',
                's.tbl_last_dt'
            )
            ->get();

        foreach ($subs as $s) {
            DB::connection('dw_sqlite')->table('fact_assignment_submission')->updateOrInsert(
                ['submission_key' => $s->submission_id],
                [
                    'student_key' => $s->student_id,
                    'course_key' => $s->course_id,
                    'assignment_id' => $s->assignment_id,
                    'score' => $s->grade,
                    'submitted_dt' => $s->submitted_on,
                    'effective_dt' => $s->tbl_last_dt,
                ]
            );
        }

        $this->info("FACT_ASSIGNMENT_SUBMISSION synced.");
    }
}
