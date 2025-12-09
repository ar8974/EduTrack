<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_ASSIGNMENT_FILE', function (Blueprint $table) {
            $table->increments('file_id');
            $table->integer('assignment_id')->nullable()->index();
            $table->string('file_path', 255)->nullable();
            $table->timestamp('uploaded_on')->nullable()->useCurrent();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_ASSIGNMENT_FILE');
    }
};
