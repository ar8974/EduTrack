<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_AUDIT_LOG', function (Blueprint $table) {
            $table->increments('audit_id');
            $table->integer('user_id')->nullable()->index();
            $table->string('action', 255)->nullable();
            $table->string('entity', 100)->nullable();
            $table->integer('entity_id')->nullable();
            $table->timestamp('action_time')->nullable()->useCurrent();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_AUDIT_LOG');
    }
};
