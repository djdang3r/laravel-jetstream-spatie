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
        Schema::create('whatsapp_websites', function (Blueprint $table) {
            $table->ulid('website_id')->primary();
            $table->foreignUuid('whatsapp_business_profile_id')
                ->constrained(
                    table: 'whatsapp_business_profiles', 
                    column: 'whatsapp_business_profile_id'
                )
                ->onDelete('cascade')
                ->index(); 
            $table->string('website', 512);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_websites');
    }
};
