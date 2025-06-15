<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_chat_sessions', function (Blueprint $table) {
            $table->ulid('session_id')->primary();
            
            // 1. Definir columnas primero
            $table->ulid('contact_id');
            $table->ulid('whatsapp_phone_id');
            $table->ulid('assigned_bot_id')->nullable();
            $table->ulid('flow_id')->nullable();
            $table->ulid('current_step_id')->nullable();
            $table->unsignedBigInteger('assigned_agent_id')->nullable(); // Asume que users usa id BIGINT
            
            // 2. Agregar foreign keys
            $table->foreign('contact_id')
                  ->references('contact_id')
                  ->on('whatsapp_contacts')
                  ->onDelete('cascade');
                  
            $table->foreign('whatsapp_phone_id')
                  ->references('phone_number_id')
                  ->on('whatsapp_phone_numbers');
                  
            $table->foreign('assigned_bot_id')
                  ->references('whatsapp_bot_id')
                  ->on('whatsapp_bots')
                  ->onDelete('set null');
                  
            $table->foreign('flow_id')
                  ->references('flow_id')
                  ->on('whatsapp_flows')
                  ->onDelete('set null');
                  
            $table->foreign('current_step_id')
                  ->references('step_id')
                  ->on('whatsapp_flow_steps')
                  ->onDelete('set null');
                  
            $table->foreign('assigned_agent_id')
                  ->references('id')
                  ->on(config('whatsapp.models.user_table')) // Columna en users (por defecto 'id')
                  ->onDelete('set null');

            // ... resto de columnas (status, context, etc.)
            $table->enum('status', ['active', 'paused', 'completed'])->default('active');
            $table->unsignedSmallInteger('validation_attempts')->default(0);
            $table->unsignedSmallInteger('max_validation_attempts')->default(3);
            $table->json('context')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->json('message_queue')->nullable();
            $table->unsignedMediumInteger('current_queue_position')->default(0);
            $table->unsignedSmallInteger('attempt_count')->default(0);
            $table->json('collected_variables')->nullable();
            $table->enum('flow_status', ['started','awaiting_input','processing','paused','in_progress','completed','failed','transferred'])
                  ->default('started');
            $table->timestamp('last_activity')->nullable();
            $table->unsignedInteger('inactivity_timeout')->default(86400);
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index('flow_status');
            $table->index('assigned_agent_id');
            $table->index('contact_id');
            $table->index('whatsapp_phone_id');
            $table->index('flow_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_chat_sessions');
    }
};