<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_ATTENDANCE', function (Blueprint $table) {
            $table->increments('attendance_id');
            $table->integer('section_id')->nullable()->index();
            $table->integer('student_id')->nullable()->index();
            $table->date('attendance_date')->nullable();
            $table->enum('status', ['Present', 'Absent', 'Late'])->nullable();
            $table->integer('marked_by')->nullable()->index();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_ATTENDANCE');
    }
};
