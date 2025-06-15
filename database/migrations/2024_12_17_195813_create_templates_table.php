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
        Schema::create('whatsapp_templates', function (Blueprint $table) {
            $table->ulid('template_id')->primary();
            $table->string('whatsapp_business_id', 200);
            $table->string('wa_template_id', 200)->unique();
            $table->string('name', 250);
            $table->string('language', 45);
            $table->foreignUlid('category_id')->nullable()->constrained('whatsapp_template_categories', 'category_id');
            $table->enum('status', ['APPROVED', 'PENDING', 'REJECTED'])->default('PENDING');
            $table->text('file')->nullable();
            $table->json('json');
            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
            $table->index('status');

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
        Schema::dropIfExists('whatsapp_templates');
    }
};
