<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class ImportFromSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Usage:
     * php artisan db:seed --class=ImportFromSqlSeeder
     * php artisan db:seed --class=ImportFromSqlSeeder --sql-file=/path/to/file.sql
     * php artisan db:seed --class=ImportFromSqlSeeder --fresh
     */
    public function run(): void
    {
        $sqlFile = $this->getSqlFilePath();
        
        if (!$sqlFile || !File::exists($sqlFile)) {
            $this->error("❌ SQL file not found: {$sqlFile}");
            return;
        }

        $this->info("📂 Using SQL file: {$sqlFile}");
        
        // Check if fresh import is requested
        $fresh = in_array('--fresh', $_SERVER['argv'] ?? []);
        
        if ($fresh) {
            $this->freshImport($sqlFile);
        } else {
            $this->normalImport($sqlFile);
        }
    }

    /**
     * Get SQL file path from command line or default locations
     */
    private function getSqlFilePath(): ?string
    {
        // Check for --sql-file option
        $args = $_SERVER['argv'] ?? [];
        foreach ($args as $arg) {
            if (str_starts_with($arg, '--sql-file=')) {
                return str_replace('--sql-file=', '', $arg);
            }
        }

        // Default locations
        $defaultFiles = [
            'dbujikom (4).sql',
            'production.sql',
            'database.sql',
            'dump.sql',
        ];

        foreach ($defaultFiles as $file) {
            $locations = [
                base_path($file),
                base_path('database/' . $file),
                storage_path($file),
                '/Users/tanziljws/Documents/webgalerisyifa/' . $file,
            ];

            foreach ($locations as $location) {
                if (File::exists($location)) {
                    return $location;
                }
            }
        }

        return null;
    }

    /**
     * Normal import (skip duplicates)
     */
    private function normalImport(string $sqlFile): void
    {
        $this->info('🚀 Starting normal import (skip duplicates)...');
        
        $seeder = new ProductionDataSeeder();
        $seeder->run();
    }

    /**
     * Fresh import (truncate all tables first)
     */
    private function freshImport(string $sqlFile): void
    {
        $this->warn('⚠️  WARNING: Fresh import will delete all existing data!');
        $this->info('Starting in 3 seconds... (Press Ctrl+C to cancel)');
        sleep(3);
        
        $this->info('🗑️  Truncating all tables...');
        
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            
            $tables = DB::select('SHOW TABLES');
            $dbName = DB::getDatabaseName();
            
            foreach ($tables as $table) {
                $tableName = $table->{'Tables_in_' . $dbName};
                
                // Skip migrations table
                if ($tableName === 'migrations') {
                    continue;
                }
                
                $this->line("  Truncating: {$tableName}");
                DB::table($tableName)->truncate();
            }
            
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            
            $this->info('✅ All tables truncated successfully');
            
        } catch (Exception $e) {
            $this->error('❌ Error truncating tables: ' . $e->getMessage());
            return;
        }
        
        // Now import
        $this->info('📥 Importing fresh data...');
        $seeder = new ProductionDataSeeder();
        $seeder->run();
    }

    private function info(string $message): void
    {
        echo "\033[32m{$message}\033[0m\n";
    }

    private function warn(string $message): void
    {
        echo "\033[33m{$message}\033[0m\n";
    }

    private function error(string $message): void
    {
        echo "\033[31m{$message}\033[0m\n";
    }

    private function line(string $message): void
    {
        echo "{$message}\n";
    }
}
