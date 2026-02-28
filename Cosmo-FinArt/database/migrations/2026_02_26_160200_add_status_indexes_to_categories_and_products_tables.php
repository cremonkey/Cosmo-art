<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table): void {
            $table->index('is_active', 'categories_is_active_idx');
        });

        Schema::table('products', function (Blueprint $table): void {
            $table->index('is_active', 'products_is_active_idx');
            $table->index('is_featured', 'products_is_featured_idx');
            $table->index(['is_active', 'is_featured'], 'products_active_featured_idx');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->dropIndex('products_active_featured_idx');
            $table->dropIndex('products_is_featured_idx');
            $table->dropIndex('products_is_active_idx');
        });

        Schema::table('categories', function (Blueprint $table): void {
            $table->dropIndex('categories_is_active_idx');
        });
    }
};

