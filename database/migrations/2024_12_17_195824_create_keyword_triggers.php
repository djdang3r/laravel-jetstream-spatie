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
        Schema::create('whatsapp_keyword_triggers', function (Blueprint $table) {
            $table->ulid('keyword_trigger_id')->primary();
            $table->json('keywords');
            $table->boolean('case_sensitive')->default(false);
            $table->enum('match_type', ['exact', 'contains', 'starts_with', 'ends_with']);
        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_keyword_triggers');
    }
};
