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
        Schema::create('conversations', function (Blueprint $table) {
            $table->uuid('conversation_id')->primary();
            $table->string('wa_conversation_id', 200)->unique();
            $table->timestamp('expiration_timestamp');
            $table->string('origin', 45);
            $table->string('pricing_model', 45)->nullable();
            $table->string('billable', 45)->nullable();
            $table->string('category', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
