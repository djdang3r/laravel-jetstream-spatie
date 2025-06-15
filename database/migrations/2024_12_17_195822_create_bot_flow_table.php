<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_bot_flow', function (Blueprint $table) {
            $table->foreignUlid('whatsapp_bot_id')
                  ->constrained('whatsapp_bots', 'whatsapp_bot_id')
                  ->cascadeOnDelete();
            $table->foreignUlid('flow_id')
                  ->constrained('whatsapp_flows', 'flow_id')
                  ->cascadeOnDelete();
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['whatsapp_bot_id', 'flow_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_bot_flow');
    }
};
