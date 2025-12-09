<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_QUESTION', function (Blueprint $table) {
            $table->increments('question_id');
            $table->integer('exam_id')->nullable()->index();
            $table->text('question_text')->nullable();
            $table->enum('question_type', ['MCQ', 'Short Answer', 'Coding'])->nullable();
            $table->decimal('points', 5, 2)->nullable();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_QUESTION');
    }
};
