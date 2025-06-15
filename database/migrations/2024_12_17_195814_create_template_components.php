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
        Schema::create('whatsapp_template_components', function (Blueprint $table) {
            $table->ulid('component_id')->primary();
            $table->foreignUlid('template_id')->constrained('whatsapp_templates', 'template_id')->onDelete('cascade');
            $table->enum('type', ['header', 'body', 'footer', 'button', 'buttons']);
            $table->json('content')->nullable(); // Contenido del componente
            $table->json('parameters')->nullable(); // Parámetros dinámicos
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_template_components');
    }
};