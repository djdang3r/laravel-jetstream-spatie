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
        Schema::create('media_files', function (Blueprint $table) {
            $table->uuid('media_file_id')->primary();
            $table->uuid('message_id');
            $table->string('media_type', 45);
            $table->string('file_name', 45);
            $table->string('mime_type', 45);
            $table->string('sha256', 45);
            $table->string('url', 1000);
            $table->string('media_id', 45);
            $table->string('file_size', 45)->nullable();
            $table->string('animated', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('message_id')
                  ->references('message_id')
                  ->on('messages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};
