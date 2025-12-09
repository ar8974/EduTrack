<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_OPTION', function (Blueprint $table) {
            $table->increments('option_id');
            $table->integer('question_id')->nullable()->index();
            $table->text('option_text')->nullable();
            $table->boolean('is_correct')->default(0);
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_OPTION');
    }
};
