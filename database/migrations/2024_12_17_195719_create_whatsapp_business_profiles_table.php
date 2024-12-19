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
        Schema::create('whatsapp_business_profiles', function (Blueprint $table) {
            $table->uuid('whatsapp_business_profile_id')->primary();
            $table->text('profile_picture_url')->nullable();
            $table->text('about')->nullable();
            $table->string('address', 256)->nullable();
            $table->string('description', 512)->nullable();
            $table->string('email', 128)->nullable();
            $table->string('vertical', 45)->nullable();
            $table->string('messaging_product', 45)->default('whatsapp');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_business_profiles');
    }
};
