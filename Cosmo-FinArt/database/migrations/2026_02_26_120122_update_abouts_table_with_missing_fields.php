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
        Schema::table('abouts', function (Blueprint $table) {
            $table->renameColumn('philosophy_text', 'philosophy_content');
            $table->renameColumn('science_text', 'science_content');
            
            $table->string('showcase_title')->nullable();
            $table->string('showcase_subtitle')->nullable();
            $table->boolean('is_visible')->default(true);
            
            $table->string('banner_title')->nullable();
            $table->text('banner_description')->nullable();
            $table->text('disclaimer_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->renameColumn('philosophy_content', 'philosophy_text');
            $table->renameColumn('science_content', 'science_text');
            
            $table->dropColumn([
                'showcase_title',
                'showcase_subtitle',
                'is_visible',
                'banner_title',
                'banner_description',
                'disclaimer_text'
            ]);
        });
    }
};
