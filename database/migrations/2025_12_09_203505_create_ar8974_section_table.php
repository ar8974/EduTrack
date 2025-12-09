<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_SECTION', function (Blueprint $table) {
            $table->increments('section_id');
            $table->integer('course_id')->nullable()->index();
            $table->integer('term_id')->nullable()->index();
            $table->integer('faculty_id')->nullable()->index();
            $table->string('schedule_day', 10)->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('room_id')->nullable()->index();
            $table->integer('capacity')->nullable();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_SECTION');
    }
};
