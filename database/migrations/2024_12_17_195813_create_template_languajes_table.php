<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('whatsapp_template_languages', function (Blueprint $table) {
            // ID personalizado (ej: "en_US")
            $table->string('id', 10)->primary();
            
            $table->string('name', 50);
            $table->string('language_code', 5);  // Código ISO 639-1
            $table->string('country_code', 2)->nullable(); // Código ISO 3166-1 alpha-2
            $table->string('variant', 5)->nullable();      // Abreviatura personalizada
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('languages');
    }
};