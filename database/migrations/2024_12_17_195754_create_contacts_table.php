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
        Schema::create('whatsapp_contacts', function (Blueprint $table) {
            $table->ulid('contact_id')->primary();
            $table->string('wa_id', 200)->unique()->nullable();
            $table->string('country_code', 45);
            $table->string('phone_number', 45);
            $table->string('contact_name', 250)->nullable();
            $table->string('first_name', 45)->nullable();
            $table->string('last_name', 45)->nullable();
            $table->string('middle_name', 45)->nullable();
            $table->string('suffix', 45)->nullable();
            $table->string('prefix', 45)->nullable();
            $table->string('organization')->nullable();
            $table->string('department')->nullable();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->date('birthday')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_contacts');
    }
};
