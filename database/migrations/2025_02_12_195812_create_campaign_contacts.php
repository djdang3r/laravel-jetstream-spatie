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
        Schema::create('whatsapp_campaign_contact', function (Blueprint $table) {
            $table->ulid('campaign_id');
            $table->ulid('contact_id');
            $table->enum('status', ['PENDING', 'SENT', 'DELIVERED', 'READ', 'FAILED']);
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->integer('response_count')->default(0); // Interacciones
            $table->text('error_details')->nullable();

            $table->primary(['campaign_id', 'contact_id']);

            $table->foreign('campaign_id')
                  ->references('campaign_id')
                  ->on('whatsapp_campaigns');

            $table->foreign('contact_id')
                  ->references('contact_id')
                  ->on('whatsapp_contacts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_campaign_contact');
    }
};
