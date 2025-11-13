#!/bin/bash

# Railway .env Updater
# Quick script to update .env with Railway credentials

echo "🔧 Railway Database Configuration Updater"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "Get your credentials from Railway Dashboard:"
echo "Project → MySQL Service → Variables tab"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# Prompt for credentials
read -p "MYSQLHOST (e.g., containers-us-west-xxx.railway.app): " MYSQLHOST
read -p "MYSQLPORT (default: 3306): " MYSQLPORT
MYSQLPORT=${MYSQLPORT:-3306}
read -p "MYSQLDATABASE (default: railway): " MYSQLDATABASE
MYSQLDATABASE=${MYSQLDATABASE:-railway}
read -p "MYSQLUSER (default: root): " MYSQLUSER
MYSQLUSER=${MYSQLUSER:-root}
read -sp "MYSQLPASSWORD: " MYSQLPASSWORD
echo ""
echo ""

# Confirm
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "Configuration to apply:"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "DB_HOST=${MYSQLHOST}"
echo "DB_PORT=${MYSQLPORT}"
echo "DB_DATABASE=${MYSQLDATABASE}"
echo "DB_USERNAME=${MYSQLUSER}"
echo "DB_PASSWORD=${MYSQLPASSWORD:0:3}***"
echo ""

read -p "Apply these changes to .env? (yes/no): " confirm

if [ "$confirm" != "yes" ]; then
    echo "❌ Cancelled"
    exit 0
fi

# Backup .env
if [ -f .env ]; then
    cp .env .env.backup.$(date +%Y%m%d_%H%M%S)
    echo "✅ Backed up .env"
fi

# Update .env
if [ -f .env ]; then
    # Use sed with proper escaping
    sed -i.bak "s|^DB_HOST=.*|DB_HOST=${MYSQLHOST}|" .env
    sed -i.bak "s|^DB_PORT=.*|DB_PORT=${MYSQLPORT}|" .env
    sed -i.bak "s|^DB_DATABASE=.*|DB_DATABASE=${MYSQLDATABASE}|" .env
    sed -i.bak "s|^DB_USERNAME=.*|DB_USERNAME=${MYSQLUSER}|" .env
    sed -i.bak "s|^DB_PASSWORD=.*|DB_PASSWORD=${MYSQLPASSWORD}|" .env
    
    # Remove backup file
    rm -f .env.bak
    
    echo "✅ Updated .env file"
else
    echo "❌ .env file not found!"
    exit 1
fi

# Clear config cache
echo "🧹 Clearing configuration cache..."
php artisan config:clear

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "✨ Configuration updated successfully!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "🔍 Testing connection..."

if php artisan migrate:status &> /dev/null; then
    echo "✅ Database connection successful!"
    echo ""
    echo "🚀 Next step: Import data"
    echo "   php artisan db:seed --class=ProductionDataSeeder"
else
    echo "❌ Database connection failed!"
    echo ""
    echo "💡 Troubleshooting:"
    echo "   1. Verify credentials in Railway dashboard"
    echo "   2. Ensure you're using PUBLIC URL (not mysql.railway.internal)"
    echo "   3. Check Railway database is running"
    echo ""
    echo "   Run diagnostics: ./diagnose.sh"
fi

echo ""
