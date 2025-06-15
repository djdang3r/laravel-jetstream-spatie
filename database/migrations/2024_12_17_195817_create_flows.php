<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Contiene los diferentes flujos conversacionales. Un flujo puede activarse por palabras clave (inbound) o 
     * mediante el envío de una plantilla (outbound). El entry_point_id indica qué paso se ejecuta primero.
     */
    public function up(): void
    {
        Schema::create('whatsapp_flows', function (Blueprint $table) {
            $table->ulid('flow_id')->primary();
            $table->string('name', 200); // Nombre interno del flujo
            $table->text('description')->nullable();
            $table->enum('type', ['inbound','outbound', 'hybrid'])->default('inbound'); // Tipo de flujo: inbound, outbound o híbrido
            $table->enum('trigger_mode', ['any', 'all']);
            $table->boolean('is_default')->default(false); // Flujo por defecto
            $table->boolean('is_active')->default(true);

            // Punto de entrada del flujo
            $table->ulid('entry_point_id')->nullable();
                
            $table->timestamps();
            $table->softDeletes();

            $table->index('type');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_flows');
    }
};
