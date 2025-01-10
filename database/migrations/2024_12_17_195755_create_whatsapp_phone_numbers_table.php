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
            $table->uuid('whatsapp_phone_id')->primary();
            $table->char('whatsapp_business_accounts_id', 36);
            $table->uuid('whatsapp_business_profile_id')->nullable();
            $table->uuid('whatsapp_bot_id')->nullable();
            $table->string('display_phone_number', 45)->unique();
            $table->string('phone_number_id', 45)->unique();
            $table->string('verified_name', 150);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('whatsapp_business_accounts_id')
                  ->references('whatsapp_business_id')
                  ->on('whatsapp_business_accounts')
                  ->onDelete('no action')
                  ->onUpdate('no action');

            $table->foreign('whatsapp_business_profile_id')
                  ->references('whatsapp_business_profile_id')
                  ->on('whatsapp_business_profiles')
                  ->onDelete('no action')
                  ->onUpdate('no action');

            $table->foreign('whatsapp_bot_id')
                  ->references('whatsapp_bot_id')
                  ->on('whatsapp_bots')
                  ->onDelete('no action')
                  ->onUpdate('no action');
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
