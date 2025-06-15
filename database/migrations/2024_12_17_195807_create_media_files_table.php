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
        Schema::create('whatsapp_media_files', function (Blueprint $table) {
            $table->ulid('media_file_id')->primary();
            $table->ulid('message_id');
            $table->string('media_type', 45);
            $table->string('file_name', 45);
            $table->string('mime_type', 45);
            $table->string('sha256', 64);
            $table->text('url');
            $table->string('media_id', 45);
            $table->string('file_size', 45)->nullable();
            $table->string('animated', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('message_id')
                  ->references('message_id')
                  ->on('whatsapp_messages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_media_files');
    }
};
