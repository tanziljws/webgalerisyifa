#!/bin/bash

# Railway Database Import Helper Script
# Author: Qoder AI
# Usage: ./railway-import.sh

set -e

echo "🚀 Railway Database Import Helper"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_info() {
    echo -e "${GREEN}ℹ️  $1${NC}"
}

# Check if .env file exists
if [ ! -f .env ]; then
    print_error ".env file not found!"
    exit 1
fi

# Load .env file
export $(grep -v '^#' .env | xargs)

# Display current database configuration
echo ""
print_info "Current Database Configuration:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "Host: ${DB_HOST}"
echo "Port: ${DB_PORT}"
echo "Database: ${DB_DATABASE}"
echo "Username: ${DB_USERNAME}"
echo ""

# Menu
echo "Select import method:"
echo "1) Laravel Seeder (Recommended)"
echo "2) MySQL Client (Direct)"
echo "3) Fresh Import (Delete all data + import)"
echo "4) Update .env with Railway credentials"
echo "5) Test database connection"
echo "6) Exit"
echo ""
read -p "Enter your choice [1-6]: " choice

case $choice in
    1)
        print_info "Running Laravel Seeder..."
        php artisan db:seed --class=ProductionDataSeeder
        print_success "Import completed via Laravel Seeder!"
        ;;
    
    2)
        print_info "Running MySQL Client import..."
        
        # Check if SQL file exists
        SQL_FILE="dbujikom (4).sql"
        if [ ! -f "$SQL_FILE" ]; then
            print_error "SQL file not found: $SQL_FILE"
            echo "Please ensure the SQL file is in the project root directory"
            exit 1
        fi
        
        # Find MySQL binary
        if command -v mysql &> /dev/null; then
            MYSQL_CMD="mysql"
        elif [ -f "/opt/homebrew/bin/mysql" ]; then
            MYSQL_CMD="/opt/homebrew/bin/mysql"
        elif [ -f "/usr/local/bin/mysql" ]; then
            MYSQL_CMD="/usr/local/bin/mysql"
        else
            print_error "MySQL client not found!"
            echo "Please install MySQL client or use method 1 (Laravel Seeder)"
            exit 1
        fi
        
        print_info "Using MySQL client: $MYSQL_CMD"
        
        # Import with MySQL client
        $MYSQL_CMD -h ${DB_HOST} -P ${DB_PORT} -u ${DB_USERNAME} -p${DB_PASSWORD} ${DB_DATABASE} < "$SQL_FILE"
        
        print_success "Import completed via MySQL Client!"
        ;;
    
    3)
        print_warning "This will DELETE all existing data!"
        read -p "Are you sure? (yes/no): " confirm
        
        if [ "$confirm" == "yes" ]; then
            print_info "Running fresh import..."
            php artisan db:seed --class=ImportFromSqlSeeder --fresh
            print_success "Fresh import completed!"
        else
            print_info "Fresh import cancelled"
        fi
        ;;
    
    4)
        print_info "Update .env with Railway credentials"
        echo ""
        echo "Please enter your Railway database credentials:"
        read -p "MYSQLHOST: " MYSQLHOST
        read -p "MYSQLPORT: " MYSQLPORT
        read -p "MYSQLDATABASE: " MYSQLDATABASE
        read -p "MYSQLUSER: " MYSQLUSER
        read -sp "MYSQLPASSWORD: " MYSQLPASSWORD
        echo ""
        
        # Backup current .env
        cp .env .env.backup
        print_success "Backed up .env to .env.backup"
        
        # Update .env file
        sed -i.bak "s/^DB_HOST=.*/DB_HOST=${MYSQLHOST}/" .env
        sed -i.bak "s/^DB_PORT=.*/DB_PORT=${MYSQLPORT}/" .env
        sed -i.bak "s/^DB_DATABASE=.*/DB_DATABASE=${MYSQLDATABASE}/" .env
        sed -i.bak "s/^DB_USERNAME=.*/DB_USERNAME=${MYSQLUSER}/" .env
        sed -i.bak "s/^DB_PASSWORD=.*/DB_PASSWORD=${MYSQLPASSWORD}/" .env
        
        # Remove backup file
        rm .env.bak
        
        print_success ".env file updated with Railway credentials!"
        
        # Clear cache
        php artisan config:clear
        print_success "Config cache cleared"
        ;;
    
    5)
        print_info "Testing database connection..."
        
        if php artisan migrate:status &> /dev/null; then
            print_success "Database connection successful!"
            php artisan migrate:status
        else
            print_error "Database connection failed!"
            echo "Please check your .env configuration"
        fi
        ;;
    
    6)
        print_info "Exiting..."
        exit 0
        ;;
    
    *)
        print_error "Invalid choice!"
        exit 1
        ;;
esac

echo ""
print_success "Done! 🎉"
