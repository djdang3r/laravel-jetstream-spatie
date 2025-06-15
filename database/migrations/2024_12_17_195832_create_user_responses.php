<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Registro histórico de todas las interacciones del usuario. Almacena tanto la entrada bruta como el valor validado.
     */
    public function up(): void
    {
        Schema::create('whatsapp_user_responses', function (Blueprint $table) {
            $table->ulid('response_id')->primary();
            $table->foreignUlid('session_id')->constrained('whatsapp_chat_sessions', 'session_id');
            $table->foreignUlid('flow_step_id')->constrained('whatsapp_flow_steps', 'step_id');
            $table->foreignUlid('message_id')->constrained('whatsapp_messages', 'message_id');
            $table->string('field_name')->nullable(); // Ej: "nombre", "telefono"
            $table->json('field_value')->nullable(); // Valor proporcionado
            $table->foreignUlid('contact_id')->constrained('whatsapp_contacts', 'contact_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['session_id', 'flow_step_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_user_responses');
    }
};
