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
        // Skip if table already has correct structure (from SQL import)
        if (Schema::hasTable('gallery_likes') && Schema::hasColumn('gallery_likes', 'foto_id')) {
            return;
        }
        
        // First, drop the existing gallery_likes table if it exists
        Schema::dropIfExists('gallery_likes');

        // Create a new gallery_likes table with the correct structure
        Schema::create('gallery_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('foto_id')->constrained('foto')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->string('session_id')->nullable();
            $table->timestamps();
            
            // Ensure one user/IP/session can only like one foto once
            $table->unique(['foto_id', 'user_id'], 'unique_user_like');
            $table->unique(['foto_id', 'ip_address'], 'unique_ip_like');
            $table->unique(['foto_id', 'session_id'], 'unique_session_like');
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
