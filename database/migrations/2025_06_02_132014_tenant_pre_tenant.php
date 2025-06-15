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
        Schema::create('pre_tenants', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->foreignUlid('plan_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'payment_pending', 'paid', 'tenant_created'])->default('pending');
            $table->string('payment_reference')->nullable();
            $table->timestamp('payment_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_tenants');
    }
};
