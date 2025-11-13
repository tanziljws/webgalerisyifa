#!/bin/bash

# Railway Database Import - Troubleshooting & Diagnostics
# Author: Qoder AI

echo "🔍 Railway Database Import - Diagnostics"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

print_success() { echo -e "${GREEN}✅ $1${NC}"; }
print_error() { echo -e "${RED}❌ $1${NC}"; }
print_warning() { echo -e "${YELLOW}⚠️  $1${NC}"; }
print_info() { echo -e "${BLUE}ℹ️  $1${NC}"; }

# Check 1: Project Directory
echo "1️⃣  Checking Project Directory..."
if [ -d "/Users/tanziljws/Documents/webgalerisyifa" ]; then
    print_success "Project directory exists"
    cd /Users/tanziljws/Documents/webgalerisyifa
else
    print_error "Project directory not found!"
    exit 1
fi
echo ""

# Check 2: .env File
echo "2️⃣  Checking .env Configuration..."
if [ -f .env ]; then
    print_success ".env file exists"
    
    # Load .env
    export $(grep -v '^#' .env | xargs)
    
    echo "   Database Configuration:"
    echo "   - Host: ${DB_HOST}"
    echo "   - Port: ${DB_PORT}"
    echo "   - Database: ${DB_DATABASE}"
    echo "   - Username: ${DB_USERNAME}"
    echo "   - Password: ${DB_PASSWORD:0:3}***"
    
    # Check for Railway URL pattern
    if [[ $DB_HOST == *"railway"* ]]; then
        print_success "Using Railway host"
    elif [[ $DB_HOST == "127.0.0.1" ]] || [[ $DB_HOST == "localhost" ]]; then
        print_warning "Using local database (not Railway)"
    else
        print_warning "Unknown host pattern"
    fi
else
    print_error ".env file not found!"
    exit 1
fi
echo ""

# Check 3: SQL File
echo "3️⃣  Checking SQL File..."
SQL_FILE="dbujikom (4).sql"

if [ -f "$SQL_FILE" ]; then
    print_success "SQL file found in project root"
    FILE_SIZE=$(du -h "$SQL_FILE" | cut -f1)
    echo "   File size: ${FILE_SIZE}"
elif [ -f "database/$SQL_FILE" ]; then
    print_success "SQL file found in database/"
    SQL_FILE="database/$SQL_FILE"
    FILE_SIZE=$(du -h "$SQL_FILE" | cut -f1)
    echo "   File size: ${FILE_SIZE}"
elif [ -f "/Users/tanziljws/Documents/webgalerisyifa/$SQL_FILE" ]; then
    print_success "SQL file found in Documents"
else
    print_error "SQL file not found in any location!"
    echo ""
    echo "Searched locations:"
    echo "  - $(pwd)/$SQL_FILE"
    echo "  - $(pwd)/database/$SQL_FILE"
    echo "  - /Users/tanziljws/Documents/webgalerisyifa/$SQL_FILE"
    echo ""
    print_info "Solution: Copy SQL file to project root"
    echo "  cp \"dbujikom (4).sql\" $(pwd)/"
fi
echo ""

# Check 4: PHP & Laravel
echo "4️⃣  Checking PHP & Laravel..."
if command -v php &> /dev/null; then
    PHP_VERSION=$(php -v | head -n 1 | cut -d " " -f 2)
    print_success "PHP installed: ${PHP_VERSION}"
else
    print_error "PHP not found!"
    exit 1
fi

if [ -f artisan ]; then
    print_success "Laravel project detected"
    LARAVEL_VERSION=$(php artisan --version | cut -d " " -f 3)
    echo "   Laravel version: ${LARAVEL_VERSION}"
else
    print_error "Not a Laravel project!"
    exit 1
fi
echo ""

# Check 5: Database Connection
echo "5️⃣  Testing Database Connection..."
if php artisan migrate:status &> /dev/null; then
    print_success "Database connection successful!"
    
    # Count tables
    TABLE_COUNT=$(php artisan tinker --execute="echo DB::select('SHOW TABLES') |> count();" 2>/dev/null)
    if [ ! -z "$TABLE_COUNT" ]; then
        echo "   Tables found: ${TABLE_COUNT}"
    fi
else
    print_error "Database connection failed!"
    echo ""
    print_info "Common issues:"
    echo "  1. Wrong Railway credentials in .env"
    echo "  2. Using internal host (mysql.railway.internal) from local"
    echo "  3. Railway database not accessible"
    echo ""
    print_info "Solutions:"
    echo "  - Get PUBLIC URL from Railway dashboard"
    echo "  - Update .env with correct credentials"
    echo "  - Run: php artisan config:clear"
fi
echo ""

# Check 6: Seeders
echo "6️⃣  Checking Seeders..."
if [ -f "database/seeders/ProductionDataSeeder.php" ]; then
    print_success "ProductionDataSeeder.php exists"
else
    print_error "ProductionDataSeeder.php not found!"
fi

if [ -f "database/seeders/ImportFromSqlSeeder.php" ]; then
    print_success "ImportFromSqlSeeder.php exists"
else
    print_error "ImportFromSqlSeeder.php not found!"
fi
echo ""

# Check 7: MySQL Client (Optional)
echo "7️⃣  Checking MySQL Client (Optional)..."
if command -v mysql &> /dev/null; then
    MYSQL_VERSION=$(mysql --version | cut -d " " -f 6 | cut -d "," -f 1)
    print_success "MySQL client installed: ${MYSQL_VERSION}"
elif [ -f "/opt/homebrew/bin/mysql" ]; then
    print_success "MySQL client found in Homebrew"
    echo "   Path: /opt/homebrew/bin/mysql"
    print_warning "Not in PATH. Add to ~/.zshrc:"
    echo '   export PATH="/opt/homebrew/opt/mysql-client/bin:$PATH"'
else
    print_warning "MySQL client not found (not required for Seeder method)"
fi
echo ""

# Check 8: File Permissions
echo "8️⃣  Checking File Permissions..."
if [ -x "railway-import.sh" ]; then
    print_success "railway-import.sh is executable"
else
    print_warning "railway-import.sh is not executable"
    echo "   Run: chmod +x railway-import.sh"
fi
echo ""

# Summary
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📊 Diagnostic Summary"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# Determine status
ALL_OK=true

if [ ! -f .env ]; then ALL_OK=false; fi
if [ ! -f "$SQL_FILE" ]; then ALL_OK=false; fi
if ! php artisan migrate:status &> /dev/null; then ALL_OK=false; fi
if [ ! -f "database/seeders/ProductionDataSeeder.php" ]; then ALL_OK=false; fi

if [ "$ALL_OK" = true ]; then
    print_success "All checks passed! Ready to import."
    echo ""
    echo "🚀 Next Steps:"
    echo "   1. Verify Railway credentials in .env"
    echo "   2. Run: php artisan db:seed --class=ProductionDataSeeder"
    echo "   OR"
    echo "   3. Run: ./railway-import.sh"
else
    print_warning "Some issues detected. Please fix them before importing."
    echo ""
    echo "💡 Quick Fixes:"
    echo "   - Missing SQL file: cp \"dbujikom (4).sql\" ."
    echo "   - Connection failed: Update .env with Railway public URL"
    echo "   - Config cache: php artisan config:clear"
fi

echo ""
echo "📚 For detailed help, read: RAILWAY_IMPORT_GUIDE.md"
echo ""
