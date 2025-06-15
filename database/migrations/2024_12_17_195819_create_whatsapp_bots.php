<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Almacena la configuración base de cada bot. Cada bot está asociado a un número de teléfono y puede tener un flujo predeterminado. 
     * El campo on_failure determina la acción cuando ocurren errores.
     */
    public function up(): void
    {
        Schema::create('whatsapp_bots', function (Blueprint $table) {
            $table->ulid('whatsapp_bot_id')->primary();
            $table->foreignUlid('phone_number_id')
                ->constrained('whatsapp_phone_numbers', 'phone_number_id')
                ->onDelete('cascade');
            $table->foreignUlid('default_flow_id')
                  ->nullable()
                  ->constrained('whatsapp_flows', 'flow_id')
                  ->nullOnDelete();
            $table->string('bot_name', 45);
            $table->text('description')->nullable();
            $table->boolean('is_enable')->default(false); // Habilitar/deshabilitar bot
            $table->enum('on_failure', ['assign_agent', 'notify', 'restart_flow'])
                    ->default('assign_agent'); // Acción si falla el flujo
            $table->text('failure_message')->nullable();
            $table->string('bot_color', 50)->nullable();
            $table->boolean('mark_messages_as_read')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('is_enable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_bots');
    }
};
