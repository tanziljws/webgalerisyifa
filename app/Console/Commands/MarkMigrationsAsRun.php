<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MarkMigrationsAsRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:mark-imported
                            {--force : Force the operation to run when in production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark all migrations as run when tables were imported from SQL dump';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Checking for imported tables...');

        // Tables that should exist from SQL import
        $expectedTables = [
            'users', 'password_reset_tokens', 'sessions', 'cache', 'cache_locks',
            'jobs', 'job_batches', 'failed_jobs', 'gallery_items', 'gallery_likes',
            'gallery_comments', 'gallery_downloads', 'kategori', 'petugas', 'posts',
            'profile', 'galery', 'foto', 'foto_comments', 'foto_likes',
            'download_logs', 'agendas', 'informasi', 'galleries'
        ];

        $existingTables = [];
        foreach ($expectedTables as $table) {
            if (Schema::hasTable($table)) {
                $existingTables[] = $table;
            }
        }

        $this->info("✅ Found " . count($existingTables) . " existing tables");

        if (count($existingTables) < 10) {
            $this->warn('⚠️  Not enough tables found. Are you sure you imported the SQL dump?');
            if (!$this->confirm('Continue anyway?')) {
                return 0;
            }
        }

        // Get all migration files
        $migrationPath = database_path('migrations');
        $migrationFiles = glob($migrationPath . '/*.php');
        
        $marked = 0;
        $skipped = 0;

        foreach ($migrationFiles as $file) {
            $migrationName = str_replace('.php', '', basename($file));
            
            // Check if migration is already recorded
            $exists = DB::table('migrations')
                ->where('migration', $migrationName)
                ->exists();
            
            if (!$exists) {
                // Insert migration record
                DB::table('migrations')->insert([
                    'migration' => $migrationName,
                    'batch' => 1,
                ]);
                $marked++;
                $this->line("  ✅ Marked: {$migrationName}");
            } else {
                $skipped++;
            }
        }

        $this->info('');
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info("✨ Completed!");
        $this->info("   Marked: {$marked} migrations");
        $this->info("   Skipped: {$skipped} (already marked)");
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info('');
        $this->info('🚀 You can now run: php artisan migrate');

        return 0;
    }
}
