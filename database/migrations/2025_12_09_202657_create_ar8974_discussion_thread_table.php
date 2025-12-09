<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_DISCUSSION_THREAD', function (Blueprint $table) {
            $table->increments('thread_id');
            $table->integer('section_id')->nullable()->index();
            $table->integer('created_by')->nullable()->index();
            $table->string('title', 200)->nullable();
            $table->timestamp('created_on')->nullable()->useCurrent();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_DISCUSSION_THREAD');
    }
};
