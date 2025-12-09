<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_COURSE', function (Blueprint $table) {
            $table->increments('course_id');
            $table->string('course_code', 20)->nullable()->unique();
            $table->string('course_name', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('dept_id')->nullable()->index();
            $table->integer('faculty_id')->nullable();
            $table->integer('credits')->nullable();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_COURSE');
    }
};
