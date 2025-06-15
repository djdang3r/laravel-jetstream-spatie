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
        Schema::create('whatsapp_phone_numbers', function (Blueprint $table) {
            $table->ulid('phone_number_id')->primary();
            $table->string('whatsapp_business_account_id', 255);
            $table->ulid('whatsapp_business_profile_id')->nullable();
            $table->string('display_phone_number', 45)->unique();
            $table->string('country_code', 45);
            $table->string('phone_number', 45);
            $table->string('api_phone_number_id', 45)->unique();
            $table->string('verified_name', 150);

            $table->string('code_verification_status', 45)->nullable();
            $table->string('quality_rating', 45)->nullable();
            $table->string('platform_type', 45)->nullable();
            $table->json('throughput')->nullable();
            $table->json('webhook_configuration')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('whatsapp_business_account_id')
                  ->references('whatsapp_business_id')
                  ->on('whatsapp_business_accounts');

            $table->foreign('whatsapp_business_profile_id')
                  ->references('whatsapp_business_profile_id')
                  ->on('whatsapp_business_profiles')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_phone_numbers');
    }
};
