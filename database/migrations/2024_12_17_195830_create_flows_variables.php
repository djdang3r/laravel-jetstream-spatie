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
        Schema::create('whatsapp_flow_variables', function (Blueprint $table) {
            $table->ulid('variable_id')->primary();
            $table->foreignUlid('flow_id')->constrained('whatsapp_flows', 'flow_id')->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['string','number','boolean'])->default('string');
            $table->json('default_value')->nullable(); // Valor inicial opcional
        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_flow_variables');
    }
};
