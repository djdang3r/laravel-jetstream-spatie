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
        Schema::create('templates', function (Blueprint $table) {
            $table->uuid('template_id')->primary();
            $table->string('whatsapp_business_id', 200);
            $table->string('wa_template_id', 200)->unique();
            $table->string('name', 250);
            $table->string('language', 45);
            $table->string('category', 45);
            $table->string('status', 45)->nullable();
            $table->text('file')->nullable();
            $table->json('json');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('whatsapp_business_id')
                  ->references('whatsapp_business_id')
                  ->on('whatsapp_business_accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
