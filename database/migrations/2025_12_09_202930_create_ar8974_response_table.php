<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_RESPONSE', function (Blueprint $table) {
            $table->increments('response_id');
            $table->integer('question_id')->nullable()->index();
            $table->integer('student_id')->nullable()->index();
            $table->integer('selected_option_id')->nullable()->index();
            $table->text('answer_text')->nullable();
            $table->decimal('score', 5, 2)->nullable();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_RESPONSE');
    }
};
