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
        Schema::create('plans', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price_monthly', 10, 2);
            $table->decimal('price_yearly', 10, 2);
            $table->integer('max_accounts');
            $table->integer('max_numbers');
            $table->integer('max_bots');
            $table->integer('max_flows_per_bot');
            $table->integer('max_messages_included');
            $table->decimal('additional_message_price', 10, 2)->default(40);
            $table->boolean('allow_massive_sending')->default(false);
            $table->boolean('allow_api_integrations')->default(false);
            $table->enum('support_level', ['basic', 'standard', 'premium'])->default('basic');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
