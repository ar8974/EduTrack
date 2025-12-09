<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_RUBRIC_SCORE', function (Blueprint $table) {
            $table->increments('rubric_score_id');
            $table->integer('rubric_id')->nullable()->index();
            $table->integer('submission_id')->nullable()->index();
            $table->decimal('score', 5, 2)->nullable();
            $table->text('comments')->nullable();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_RUBRIC_SCORE');
    }
};
