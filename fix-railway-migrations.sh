#!/bin/bash

# Fix Railway Migration Issues
# This script fixes migration conflicts when deploying to Railway

echo "🔧 Fixing Railway Migration Issues..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: Not in Laravel project root directory!"
    exit 1
fi

echo "📋 Step 1: Marking existing migrations as run..."
php artisan migrate:mark-imported --force

echo ""
echo "📋 Step 2: Running any new migrations..."
php artisan migrate --force

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "✅ Migration fix completed!"
echo ""
echo "Next steps:"
echo "  1. Deploy to Railway: git push"
echo "  2. Railway will auto-deploy"
echo "  3. Check Railway logs: railway logs"
echo ""
