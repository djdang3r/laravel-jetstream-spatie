<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Almacena mensajes asociados a un paso. Un paso puede tener múltiples mensajes que se enviarán secuencialmente. 
     * El delay_seconds permite crear pausas entre mensajes.
     */
    public function up(): void
    {
        Schema::create('whatsapp_step_messages', function (Blueprint $table) {
            $table->ulid('message_id')->primary();
            $table->foreignUlid('flow_step_id')->constrained('whatsapp_flow_steps', 'step_id')->onDelete('cascade');
            $table->enum('message_type', ['text', 'image', 'video', 'document', 'audio', 'location','quick_reply']);
            $table->text('content'); // Puede contener variables {nombre}
            $table->foreignUlid('media_file_id')->nullable()->constrained('whatsapp_media_files', 'media_file_id');
            $table->unsignedInteger('delay_seconds')->default(0); // Espera antes de enviar
            $table->unsignedSmallInteger('order')->default(0); // Orden de secuencia
            $table->json('variables_used')->nullable(); // Ej: ["nombre", "email"]
            $table->timestamps();
            $table->softDeletes();

            $table->index(['flow_step_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_step_messages');
    }
};
