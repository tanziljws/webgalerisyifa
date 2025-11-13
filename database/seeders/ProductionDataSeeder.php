<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class ProductionDataSeeder extends Seeder
{
    /**
     * SQL file name to import
     */
    private const SQL_FILE = 'dbujikom (4).sql';

    /**
     * Possible locations for SQL file
     */
    private array $sqlLocations = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->initializeLocations();
        
        $this->info('🚀 Starting Production Data Import...');
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');

        // Find SQL file
        $sqlPath = $this->findSqlFile();
        if (!$sqlPath) {
            $this->error('❌ SQL file not found in any location!');
            $this->showSearchLocations();
            return;
        }

        $this->info("✅ Found SQL file: {$sqlPath}");

        // Read and clean SQL
        $this->info('📖 Reading SQL file...');
        $sqlContent = File::get($sqlPath);
        
        $this->info('🧹 Cleaning SQL statements...');
        $sqlContent = $this->cleanSqlContent($sqlContent);

        // Parse statements
        $statements = $this->parseSqlStatements($sqlContent);
        $totalStatements = count($statements);
        
        $this->info("📝 Found {$totalStatements} SQL statements to execute");
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');

        // Execute with transaction
        $this->executeStatements($statements);
        
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info('✨ Production data import completed successfully!');
        $this->info('');
        
        // Mark migrations as run to prevent conflicts
        $this->info('📝 Marking migrations as run...');
        $this->markMigrationsAsRun();
        $this->info('✅ Migrations marked successfully!');
    }

    /**
     * Initialize possible SQL file locations
     */
    private function initializeLocations(): void
    {
        $this->sqlLocations = [
            base_path(self::SQL_FILE),
            base_path('database/' . self::SQL_FILE),
            base_path('database/seeders/' . self::SQL_FILE),
            base_path('database/seeders/sql/' . self::SQL_FILE),
            base_path('storage/' . self::SQL_FILE),
            storage_path(self::SQL_FILE),
            storage_path('app/' . self::SQL_FILE),
            '/Users/tanziljws/Downloads/' . self::SQL_FILE,
            '/Users/tanziljws/Documents/' . self::SQL_FILE,
        ];
    }

    /**
     * Find SQL file in possible locations
     */
    private function findSqlFile(): ?string
    {
        foreach ($this->sqlLocations as $location) {
            if (File::exists($location)) {
                return $location;
            }
        }
        return null;
    }

    /**
     * Clean SQL content from problematic statements
     */
    private function cleanSqlContent(string $content): string
    {
        // Remove SQL mode settings
        $content = preg_replace('/SET SQL_MODE.*?;/i', '', $content);
        
        // Remove character set settings
        $content = preg_replace('/\/\*!40101 SET.*?\*\/;?/i', '', $content);
        
        // Remove CREATE DATABASE statements
        $content = preg_replace('/CREATE DATABASE.*?;/i', '', $content);
        
        // Remove USE statements
        $content = preg_replace('/USE `.*?`;/i', '', $content);
        
        // Remove CREATE TABLE statements (tables already exist on Railway)
        $content = preg_replace('/CREATE TABLE.*?;/is', '', $content);
        
        // Remove ALTER TABLE statements (schema already exists)
        $content = preg_replace('/ALTER TABLE.*?;/i', '', $content);
        
        // Remove DROP TABLE statements
        $content = preg_replace('/DROP TABLE.*?;/i', '', $content);
        
        // Remove START TRANSACTION and COMMIT (we'll use our own)
        $content = preg_replace('/START TRANSACTION;/i', '', $content);
        $content = preg_replace('/COMMIT;/i', '', $content);
        
        // Remove comments
        $content = preg_replace('/^--.*$/m', '', $content);
        $content = preg_replace('/\/\*.*?\*\//s', '', $content);
        
        return trim($content);
    }

    /**
     * Parse SQL content into individual statements
     */
    private function parseSqlStatements(string $content): array
    {
        // Split by semicolon but be careful with strings
        $statements = [];
        $buffer = '';
        $inString = false;
        $stringChar = '';
        
        for ($i = 0; $i < strlen($content); $i++) {
            $char = $content[$i];
            
            // Handle string delimiters
            if (($char === '"' || $char === "'") && ($i === 0 || $content[$i - 1] !== '\\')) {
                if (!$inString) {
                    $inString = true;
                    $stringChar = $char;
                } elseif ($char === $stringChar) {
                    $inString = false;
                }
            }
            
            // Add to buffer
            $buffer .= $char;
            
            // Check for statement end
            if ($char === ';' && !$inString) {
                $statement = trim($buffer);
                if (!empty($statement) && $statement !== ';') {
                    $statements[] = $statement;
                }
                $buffer = '';
            }
        }
        
        // Add remaining buffer
        if (!empty(trim($buffer))) {
            $statements[] = trim($buffer);
        }
        
        return array_filter($statements, function($stmt) {
            return !empty($stmt) && $stmt !== ';';
        });
    }

    /**
     * Execute SQL statements with transaction
     */
    private function executeStatements(array $statements): void
    {
        $total = count($statements);
        $success = 0;
        $failed = 0;
        $skipped = 0;

        DB::beginTransaction();
        
        try {
            foreach ($statements as $index => $statement) {
                $number = $index + 1;
                
                try {
                    // Show progress
                    if ($number % 10 === 0 || $number === 1 || $number === $total) {
                        $this->showProgress($number, $total);
                    }
                    
                    DB::unprepared($statement);
                    $success++;
                    
                } catch (Exception $e) {
                    // Check if it's a duplicate entry error (safe to skip)
                    if (str_contains($e->getMessage(), 'Duplicate entry')) {
                        $skipped++;
                        $this->warn("⚠️  Skipped duplicate entry (statement #{$number})");
                    } else {
                        $failed++;
                        $this->error("❌ Error in statement #{$number}: " . $e->getMessage());
                        
                        // Show the problematic statement
                        $this->warn("Statement: " . substr($statement, 0, 100) . '...');
                    }
                }
            }
            
            DB::commit();
            
            $this->info('');
            $this->info("📊 Import Summary:");
            $this->info("   ✅ Success: {$success}");
            if ($skipped > 0) {
                $this->info("   ⚠️  Skipped: {$skipped}");
            }
            if ($failed > 0) {
                $this->warn("   ❌ Failed: {$failed}");
            }
            
        } catch (Exception $e) {
            DB::rollBack();
            $this->error('❌ Transaction rolled back due to error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Show progress bar
     */
    private function showProgress(int $current, int $total): void
    {
        $percentage = round(($current / $total) * 100);
        $bar = str_repeat('█', (int)($percentage / 2));
        $empty = str_repeat('░', 50 - strlen($bar));
        
        $this->info(sprintf(
            '⏳ Progress: [%s%s] %d%% (%d/%d)',
            $bar,
            $empty,
            $percentage,
            $current,
            $total
        ));
    }

    /**
     * Show search locations
     */
    private function showSearchLocations(): void
    {
        $this->warn('Searched in the following locations:');
        foreach ($this->sqlLocations as $location) {
            $exists = File::exists($location) ? '✅' : '❌';
            $this->line("{$exists} {$location}");
        }
        
        $this->info('');
        $this->info('💡 Solution: Copy your SQL file to one of these locations:');
        $this->line('   1. Project root: ' . base_path(self::SQL_FILE));
        $this->line('   2. Database folder: ' . base_path('database/' . self::SQL_FILE));
    }

    /**
     * Mark all migrations as run in the migrations table
     */
    private function markMigrationsAsRun(): void
    {
        try {
            // Get all migration files
            $migrationPath = database_path('migrations');
            $migrationFiles = glob($migrationPath . '/*.php');
            
            $marked = 0;
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
                }
            }
            
            if ($marked > 0) {
                $this->info("   Marked {$marked} migrations as run");
            }
        } catch (Exception $e) {
            $this->warn('   Could not mark migrations (this is okay): ' . $e->getMessage());
        }
    }

    /**
     * Output info message
     */
    private function info(string $message): void
    {
        echo "\033[32m{$message}\033[0m\n";
    }

    /**
     * Output warning message
     */
    private function warn(string $message): void
    {
        echo "\033[33m{$message}\033[0m\n";
    }

    /**
     * Output error message
     */
    private function error(string $message): void
    {
        echo "\033[31m{$message}\033[0m\n";
    }

    /**
     * Output line message
     */
    private function line(string $message): void
    {
        echo "{$message}\n";
    }
}
