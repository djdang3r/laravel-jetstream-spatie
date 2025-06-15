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
        Schema::create('whatsapp_flow_triggers', function (Blueprint $table) {
            $table->ulid('trigger_id')->primary();
            $table->foreignUlid('flow_id')->constrained('whatsapp_flows', 'flow_id')->onDelete('cascade');
            $table->enum('type', ['keyword', 'regex', 'template']); // keyword, regex, template
            $table->ulidMorphs('triggerable'); // triggerable_id + triggerable_type
        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_flow_triggers');
    }
};
