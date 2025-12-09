<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('ADVANCED_PROJECT')->create('AR8974_MESSAGE', function (Blueprint $table) {
            $table->integer('message_id');
            $table->integer('sent_year')
                  ->storedAs('YEAR(sent_on)');
            
            $table->integer('sender_id')->nullable()->index();
            $table->integer('receiver_id')->nullable()->index();
            $table->string('subject', 255)->nullable();
            $table->text('body')->nullable();
            $table->timestamp('sent_on')->nullable()->useCurrent();
            $table->timestamp('tbl_last_dt')->nullable();

            $table->primary(['message_id', 'sent_year']);
        });
    }

    public function down(): void
    {
        Schema::connection('ADVANCED_PROJECT')->dropIfExists('AR8974_MESSAGE');
    }
};
