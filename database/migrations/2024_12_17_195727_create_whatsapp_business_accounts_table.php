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
            $table->string('whatsapp_business_id', 255)->primary();
            $table->string('phone_number_id', 45)->nullable();
            $table->char('name', 250);
            $table->text('api_token')->nullable();
            $table->char('app_id', 20)->unique()->nullable();
            $table->char('app_name', 250)->nullable();
            $table->text('app_link')->nullable();
            $table->string('currency', 10)->nullable();
            $table->string('webhook_token', 200)->nullable();
            $table->integer('timezone_id');
            $table->text('message_template_namespace');
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
