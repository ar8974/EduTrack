<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_USER_SECURITY', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('question_id');
            $table->string('answer_hash', 255)->nullable();
            $table->timestamp('tbl_last_dt')->nullable();

            $table->primary(['user_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_USER_SECURITY');
    }
};
