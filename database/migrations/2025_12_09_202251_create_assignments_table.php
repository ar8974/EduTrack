<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_ASSIGNMENT', function (Blueprint $table) {
            $table->increments('assignment_id');
            $table->integer('section_id')->nullable()->index();
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->decimal('total_points', 6, 2)->nullable();
            $table->boolean('is_team_based')->default(0);
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_ASSIGNMENT');
    }
};
