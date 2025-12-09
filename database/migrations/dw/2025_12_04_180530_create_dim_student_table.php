<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $conn = 'dw_sqlite';

        Schema::connection($conn)->create('dim_student', function (Blueprint $table) {
            $table->integer('student_key')->primary();
            $table->integer('student_id')->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('department_name', 100)->nullable();
            $table->string('email', 150)->nullable();
            $table->date('expiry_dt')->nullable();
            $table->char('record_active', 1)->default('Y');
            $table->date('effective_dt')->nullable();
        });

        Schema::connection($conn)->create('dim_course', function (Blueprint $table) {
            $table->integer('course_key')->primary();
            $table->integer('course_id')->nullable();
            $table->string('course_code', 50)->nullable();
            $table->string('course_name', 150)->nullable();
            $table->string('department_name', 100)->nullable();
            $table->string('term_name', 100)->nullable();
            $table->date('expiry_dt')->nullable();
            $table->char('record_active', 1)->default('Y');
            $table->integer('faculty_id')->nullable();
            $table->date('effective_dt')->nullable();
       });

        Schema::connection($conn)->create('dim_faculty', function (Blueprint $table) {
            $table->integer('faculty_key')->primary();
            $table->integer('faculty_id')->unique()->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('department_name', 100)->nullable();
            $table->string('email', 150)->nullable();
            $table->date('effective_dt')->nullable();
        });

        Schema::connection($conn)->create('fact_enrollment', function (Blueprint $table) {
            $table->integer('enrollment_key')->primary();
            $table->integer('student_key')->nullable();
            $table->integer('course_key')->nullable();
            $table->date('enrollment_date')->nullable();
            $table->string('status', 50)->nullable();
            $table->integer('course_id')->nullable();
            $table->date('effective_dt')->nullable();
        });

        Schema::connection($conn)->create('fact_attendance', function (Blueprint $table) {
            $table->integer('attendance_key')->primary();
            $table->integer('student_key')->nullable();
            $table->integer('course_key')->nullable();
            $table->date('attendance_date')->nullable();
            $table->string('status', 10)->nullable();
            $table->date('effective_dt')->nullable();
        });

        Schema::connection($conn)->create('fact_grade', function (Blueprint $table) {
            $table->integer('grade_key')->primary();
            $table->integer('student_key')->nullable();
            $table->integer('course_key')->nullable();
            $table->string('grade', 5)->nullable();
            $table->decimal('grade_points', 5, 2)->nullable();
            $table->string('term_name', 100)->nullable();
            $table->date('effective_dt')->nullable();
        });

        Schema::connection($conn)->create('fact_assignment_submission', function (Blueprint $table) {
            $table->integer('submission_key')->primary();
            $table->integer('student_key')->nullable();
            $table->integer('course_key')->nullable();
            $table->integer('assignment_id')->nullable();
            $table->decimal('score', 8, 2)->nullable();
            $table->date('submitted_dt')->nullable();
            $table->date('effective_dt')->nullable();
        });
    }

    public function down()
    {
        $conn = 'dw_sqlite';
        Schema::connection($conn)->dropIfExists('fact_assignment_submission');
        Schema::connection($conn)->dropIfExists('fact_grade');
        Schema::connection($conn)->dropIfExists('fact_attendance');
        Schema::connection($conn)->dropIfExists('fact_enrollment');
        Schema::connection($conn)->dropIfExists('dim_faculty');
        Schema::connection($conn)->dropIfExists('dim_course');
        Schema::connection($conn)->dropIfExists('dim_student');
    }
};
