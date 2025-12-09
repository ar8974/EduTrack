<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_DISCUSSION_POST', function (Blueprint $table) {
            $table->increments('post_id');
            $table->integer('thread_id')->nullable()->index();
            $table->integer('user_id')->nullable()->index();
            $table->text('message')->nullable();
            $table->timestamp('posted_on')->nullable()->useCurrent();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_DISCUSSION_POST');
    }
};
