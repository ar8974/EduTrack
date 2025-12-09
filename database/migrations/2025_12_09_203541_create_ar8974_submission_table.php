<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_SUBMISSION', function (Blueprint $table) {
            $table->increments('submission_id');
            $table->integer('assignment_id')->nullable()->index();
            $table->integer('student_id')->nullable()->index();
            $table->dateTime('submitted_on')->nullable();
            $table->string('file_path', 255)->nullable();
            $table->decimal('grade', 5, 2)->nullable();
            $table->text('feedback')->nullable();
            $table->integer('graded_by')->nullable()->index();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_SUBMISSION');
    }
};
