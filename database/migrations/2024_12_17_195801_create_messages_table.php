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
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('message_id')->primary();
            $table->uuid('whatsapp_phone_id');
            $table->uuid('contact_id');
            $table->uuid('conversation_id')->nullable();
            $table->string('wa_id', 100);
            $table->string('messaging_product', 45);
            $table->string('message_method', 45)->default('INPUT');
            $table->string('message_from', 45);
            $table->string('message_to', 45);
            $table->string('message_type', 45);
            $table->text('message_content');
            $table->string('media_url', 45)->nullable();
            $table->string('message_context', 45)->nullable();
            $table->string('caption', 45)->nullable();
            $table->json('json_content')->nullable();
            $table->string('delivered_at', 45)->nullable();
            $table->string('readed_at', 45)->nullable();
            $table->string('edited_at', 45)->nullable();
            $table->json('json')->nullable();
            $table->boolean('bot')->default(false); // Añadir el campo booleano 'bot'
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('contact_id')
                  ->references('contact_id')
                  ->on('contacts');

            $table->foreign('conversation_id')
                  ->references('conversation_id')
                  ->on('conversations');

            $table->foreign('whatsapp_phone_id')
                  ->references('whatsapp_phone_id')
                  ->on('whatsapp_phone_numbers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
