<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Agregar FK a flow_steps
        Schema::table('whatsapp_flow_steps', function (Blueprint $table) {
            $table->foreign('flow_id')
                  ->references('flow_id')
                  ->on('whatsapp_flows')
                  ->onDelete('cascade');

            $table->foreign('failure_step_id')
                  ->references('step_id')
                  ->on('whatsapp_flow_steps')
                  ->onDelete('set null');
        });

        // Agregar FK a flows
        Schema::table('whatsapp_flows', function (Blueprint $table) {
            $table->foreign('entry_point_id')
                  ->references('step_id')
                  ->on('whatsapp_flow_steps')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('whatsapp_flow_steps', function (Blueprint $table) {
            $table->dropForeign(['flow_id']);
            $table->dropForeign(['failure_step_id']);
        });

        Schema::table('whatsapp_flows', function (Blueprint $table) {
            $table->dropForeign(['entry_point_id']);
        });
    }
};