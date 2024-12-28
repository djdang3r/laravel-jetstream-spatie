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
        Schema::create('websites', function (Blueprint $table) {
            $table->uuid('website_id')->primary();
            $table->uuid('whatsapp_business_profile_id');
            $table->string('website', 45);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('whatsapp_business_profile_id')
                  ->references('whatsapp_business_profile_id')
                  ->on('whatsapp_business_profiles')
                  ->onDelete('no action')
                  ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
