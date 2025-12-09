<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_DEPARTMENT', function (Blueprint $table) {
            $table->increments('dept_id');
            $table->string('dept_name', 100)->nullable();
            $table->string('description', 250)->nullable();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_DEPARTMENT');
    }
};
