<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_USER', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email', 255)->unique();
            $table->string('password_hash', 255);
            $table->integer('role_id')->index();
            $table->integer('dept_id')->nullable()->index();
            $table->boolean('is_active')->default(1);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('tbl_last_dt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_USER');
    }
};
