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
        Schema::create('whatsapp_campaign_metrics', function (Blueprint $table) {
            $table->ulid('campaign_id')->primary();
            $table->integer('sent')->default(0);
            $table->integer('delivered')->default(0);
            $table->integer('read')->default(0);
            $table->integer('failed')->default(0);
            $table->integer('positive_responses')->default(0); // Ej: "Sí", "Comprar"
            $table->integer('negative_responses')->default(0); // Ej: "No", "Cancelar"
            $table->integer('opt_outs')->default(0); // Bajas
            
            $table->foreign('campaign_id')->references('campaign_id')->on('whatsapp_campaigns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_campaign_metrics');
    }
};
