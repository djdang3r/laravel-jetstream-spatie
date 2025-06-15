<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('whatsapp_regex_triggers', function (Blueprint $table) {
            $table->ulid('regex_trigger_id')->primary();
            $table->string('pattern');
            $table->string('flags')->nullable();
            $table->boolean('match_full')->default(true);
        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_regex_triggers');
    }
};
