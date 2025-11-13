<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Foto;
use App\Observers\FotoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the Foto observer
        Foto::observe(FotoObserver::class);
        
        // Auto-fix agendas table if it's missing or incomplete
        try {
            if (!Schema::hasTable('agendas')) {
                Schema::create('agendas', function (Blueprint $table) {
                    $table->id();
                    $table->string('title');
                    $table->text('description');
                    $table->string('photo_path')->nullable();
                    $table->dateTime('scheduled_at')->nullable();
                    $table->enum('status', ['Aktif','Nonaktif'])->default('Aktif');
                    $table->timestamps();
                });
            } else {
                Schema::table('agendas', function (Blueprint $table) {
                    if (!Schema::hasColumn('agendas', 'title')) {
                        $table->string('title')->after('id');
                    }
                    if (!Schema::hasColumn('agendas', 'description')) {
                        $table->text('description')->nullable();
                    }
                    if (!Schema::hasColumn('agendas', 'photo_path')) {
                        $table->string('photo_path')->nullable();
                    }
                    if (!Schema::hasColumn('agendas', 'scheduled_at')) {
                        $table->dateTime('scheduled_at')->nullable();
                    }
                    if (!Schema::hasColumn('agendas', 'status')) {
                        $table->enum('status', ['Aktif','Nonaktif'])->default('Aktif');
                    }
                    if (!Schema::hasColumn('agendas', 'created_at') && !Schema::hasColumn('agendas', 'updated_at')) {
                        $table->timestamps();
                    }
                });
            }
        } catch (\Throwable $e) {
            // swallow to avoid breaking boot sequence; real errors will appear on first insert
        }
    }
}
