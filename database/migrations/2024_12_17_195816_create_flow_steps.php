<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Cada paso del flujo conversacional. El step_type determina el comportamiento. 
     * Los pasos terminales finalizan la conversación. Los reintentos se manejan con max_attempts y retry_message.
     */
    public function up(): void
    {
        Schema::create('whatsapp_flow_steps', function (Blueprint $table) {
            $table->ulid('step_id')->primary();
            $table->ulid('flow_id');
            $table->string('name', 200);
            $table->unsignedInteger('order')->default(0);
            $table->enum('step_type', ['message_sequence','open_question','closed_question','conditional','terminal','api_call']);

            $table->json('validation_rules')->nullable(); // Reglas de validación {type: 'email', regex: '/.../', etc}
            $table->unsignedTinyInteger('max_attempts')->default(1);
            $table->text('retry_message')->nullable();

            $table->enum('failure_action', ['repeat','redirect','end_flow','transfer'])->default('end_flow'); // Acción si falla la validación
            $table->ulid('failure_step_id')->nullable();
            $table->boolean('is_terminal')->default(false); // Finaliza el flujo
            $table->boolean('is_entry_point')->default(false); // Paso inicial

            $table->string('api_endpoint')->nullable();
            $table->enum('http_method', ['GET','POST','PUT','PATCH','DELETE'])->nullable();
            $table->json('request_mapping')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('step_type');
            $table->index(['flow_id', 'is_entry_point']);
        });
    }

     /* Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_flow_steps');
    }
};
