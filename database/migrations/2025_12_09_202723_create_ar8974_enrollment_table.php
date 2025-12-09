<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_ENROLLMENT', function (Blueprint $table) {
            $table->increments('enrollment_id');
            $table->integer('section_id')->nullable()->index();
            $table->integer('student_id')->nullable()->index();
            $table->date('enrolled_on')->nullable()->default(DB::raw('CURDATE()'));
            $table->decimal('final_grade', 5, 2)->nullable();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_ENROLLMENT');
    }
};
