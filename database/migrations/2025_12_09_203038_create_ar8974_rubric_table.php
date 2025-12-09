<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_RUBRIC', function (Blueprint $table) {
            $table->increments('rubric_id');
            $table->integer('assignment_id')->nullable()->index();
            $table->string('criterion', 255)->nullable();
            $table->decimal('max_score', 5, 2)->nullable();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_RUBRIC');
    }
};
