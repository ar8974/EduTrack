<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_ANNOUNCEMENT', function (Blueprint $table) {
            $table->increments('announcement_id');
            $table->integer('section_id')->nullable()->index();
            $table->integer('posted_by')->nullable()->index();
            $table->string('title', 200)->nullable();
            $table->text('message')->nullable();
            $table->timestamp('posted_on')->nullable()->useCurrent();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_ANNOUNCEMENT');
    }
};
