# 🚀 Quick Reference - Railway Database Import

## 📦 Files Created
1. `ProductionDataSeeder.php` - Main seeder with auto-detection
2. `ImportFromSqlSeeder.php` - Advanced seeder with options
3. `railway-import.sh` - Interactive helper script
4. `RAILWAY_IMPORT_GUIDE.md` - Complete documentation

---

## ⚡ Quick Commands

### Method 1: Seeder (Recommended)
```bash
# 1. Copy SQL file to project root
cp "dbujikom (4).sql" .

# 2. Update .env with Railway credentials
# (Edit DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 3. Import
php artisan db:seed --class=ProductionDataSeeder
```

### Method 2: Helper Script
```bash
./railway-import.sh
# Select option 1 (Laravel Seeder)
```

### Method 3: Fresh Import
```bash
php artisan db:seed --class=ImportFromSqlSeeder --fresh
```

---

## 🔧 Setup Railway Database

### Get Credentials from Railway Dashboard

1. Go to your Railway project
2. Click on MySQL service
3. Go to **Variables** tab
4. Copy these values:

```env
MYSQLHOST=containers-us-west-xxx.railway.app
MYSQLPORT=3306
MYSQLDATABASE=railway
MYSQLUSER=root
MYSQLPASSWORD=xxx
```

### Update .env

```bash
DB_CONNECTION=mysql
DB_HOST=containers-us-west-xxx.railway.app  # Use PUBLIC URL
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=your-password-here
```

**⚠️ Important:** Use PUBLIC URL, NOT `mysql.railway.internal`

---

## 📍 SQL File Locations

The seeder searches for `dbujikom (4).sql` in:
1. ✅ `/Users/tanziljws/Documents/webgalerisyifa/dbujikom (4).sql`
2. `/Users/tanziljws/Documents/webgalerisyifa/database/dbujikom (4).sql`
3. `/Users/tanziljws/Downloads/dbujikom (4).sql`

Place your SQL file in any of these locations.

---

## 🎯 Common Tasks

### Test Database Connection
```bash
php artisan migrate:status
```

### View Import Progress
```bash
php artisan db:seed --class=ProductionDataSeeder -v
```

### Fresh Import (Delete All + Import)
```bash
php artisan db:seed --class=ImportFromSqlSeeder --fresh
```

### Verify Data After Import
```bash
php artisan tinker
> DB::table('users')->count();
> DB::table('foto')->count();
> DB::table('kategori')->count();
```

---

## 🐛 Quick Fixes

### Error: Connection refused
```bash
# ❌ Wrong
DB_HOST=mysql.railway.internal

# ✅ Correct
DB_HOST=containers-us-west-xxx.railway.app
```

### Error: SQL file not found
```bash
# Copy to project root
cp "dbujikom (4).sql" /Users/tanziljws/Documents/webgalerisyifa/
```

### Error: Duplicate entry
```bash
# This is normal! Seeder auto-skips duplicates
# Or use fresh import:
php artisan db:seed --class=ImportFromSqlSeeder --fresh
```

### Error: MySQL command not found
```bash
# Use Laravel Seeder instead (no MySQL client needed)
php artisan db:seed --class=ProductionDataSeeder
```

---

## 📊 Expected Data Counts

After successful import, you should have:
- Users: 17
- Petugas: 6
- Kategori: 12
- Foto: 94
- Agendas: 15
- Informasi: 11

---

## 🔄 Update .env Helper

```bash
./railway-import.sh
# Select option 4 (Update .env)
```

Or manually:
```bash
# Backup current .env
cp .env .env.backup

# Edit .env
nano .env
# Update DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD

# Clear config cache
php artisan config:clear
```

---

## 🎬 Full Workflow

```bash
# 1. Navigate to project
cd /Users/tanziljws/Documents/webgalerisyifa

# 2. Ensure SQL file is present
ls -la "dbujikom (4).sql"

# 3. Update .env with Railway credentials
nano .env

# 4. Test connection
php artisan migrate:status

# 5. Run import
php artisan db:seed --class=ProductionDataSeeder

# 6. Verify
php artisan tinker
> DB::table('users')->count();
```

---

## 📞 Need Help?

Check full documentation: `RAILWAY_IMPORT_GUIDE.md`

Or run interactive helper:
```bash
./railway-import.sh
```

---

**Happy Deploying! 🚀**
