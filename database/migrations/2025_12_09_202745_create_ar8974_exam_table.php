<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_EXAM', function (Blueprint $table) {
            $table->increments('exam_id');
            $table->integer('section_id')->nullable()->index();
            $table->string('title', 200)->nullable();
            $table->dateTime('exam_date')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_EXAM');
    }
};
