<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Define las variables que un paso necesita recolectar. Ejemplo de uso: validar un email con data_type: 'email'.
     */
    public function up(): void
    {
        Schema::create('whatsapp_step_variables', function (Blueprint $table) {
            $table->ulid('variable_id')->primary();
            $table->foreignUlid('flow_step_id')->constrained('whatsapp_flow_steps', 'step_id')->onDelete('cascade');
            $table->string('name')->index(); // Nombre único en el paso
            $table->enum('type', ['string', 'number', 'boolean', 'datetime','email','phone','custom_regex'])->default('string');
            $table->string('validation_regex')->nullable(); // Solo para tipo 'custom_regex'
            $table->text('error_message')->nullable(); // Mensaje personalizado de error
            $table->boolean('is_required')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['flow_step_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_step_variables');
    }
};
