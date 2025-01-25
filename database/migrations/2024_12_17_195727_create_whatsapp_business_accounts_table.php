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
        Schema::create('whatsapp_business_accounts', function (Blueprint $table) {
            $table->char('whatsapp_business_id', 36)->primary();
            $table->text('api_token')->nullable();
            $table->char('app_id', 20)->unique()->nullable();
            $table->string('webhook_token', 200)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_business_accounts');
    }
};
