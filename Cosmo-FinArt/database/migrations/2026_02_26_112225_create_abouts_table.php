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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->text('hero_text')->nullable();
            $table->string('hero_image')->nullable();
            
            $table->string('philosophy_subtitle')->nullable();
            $table->string('philosophy_title')->nullable();
            $table->text('philosophy_text')->nullable();
            $table->string('philosophy_image')->nullable();
            
            $table->string('science_title')->nullable();
            $table->text('science_text')->nullable();
            $table->string('science_image')->nullable();
            
            $table->json('infographics')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
