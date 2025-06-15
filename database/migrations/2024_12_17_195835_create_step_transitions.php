<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    * Run the migrations.
    * Define las transiciones entre pasos. Ejemplo de condition_config:
    * json
    * {
    *     "variable": "edad",
    *     "operator": ">=",
    *     "value": 18
    * }
    * Las condiciones se evalúan en orden de prioridad (mayor primero).
    */
    public function up(): void
    {
        Schema::create('whatsapp_step_transitions', function (Blueprint $table) {
            $table->ulid('transition_id')->primary();
            
            // Pasos involucrados
            $table->foreignUlid('from_step_id')
                ->constrained('whatsapp_flow_steps', 'step_id')
                ->onDelete('cascade');
            $table->foreignUlid('to_step_id')
                ->constrained('whatsapp_flow_steps', 'step_id')
                ->onDelete('cascade');
            
            // Tipo de condición
            $table->enum('condition_type', [
                'always',           // Transición incondicional
                'exact_match',      // Coincidencia exacta
                'regex_match',      // Expresión regular
                'variable_value',   // Comparación de variable
                'custom_script'     // Lógica personalizada
            ])->default('always');
            
            // Configuración de condición (JSON)
            $table->json('condition_config')->nullable();
            
            // Prioridad de evaluación
            $table->unsignedSmallInteger('priority')->default(0);
            
            // Auditoría
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index(['from_step_id', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_step_transitions');
    }
};
