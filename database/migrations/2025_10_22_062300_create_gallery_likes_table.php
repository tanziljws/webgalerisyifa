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
        // Skip if table already exists (from SQL import)
        if (Schema::hasTable('gallery_likes')) {
            return;
        }
        
        Schema::create('gallery_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained()->onDelete('cascade');
            $table->string('guest_name')->nullable();
            $table->string('ip_address')->nullable();
            $table->enum('status', ['like', 'dislike'])->default('like');
            $table->timestamps();
            
            $table->index(['gallery_id', 'ip_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_likes');
    }
};






