# 🚀 Railway Database Import Guide

Complete guide for importing SQL dump to Railway MySQL database.

## 📋 Table of Contents
- [Quick Start](#quick-start)
- [Method 1: Laravel Seeder (Recommended)](#method-1-laravel-seeder-recommended)
- [Method 2: MySQL Client](#method-2-mysql-client)
- [Method 3: Railway Shell](#method-3-railway-shell)
- [Troubleshooting](#troubleshooting)
- [FAQ](#faq)

---

## 🎯 Quick Start

### Prerequisites
1. SQL file: `dbujikom (4).sql`
2. Railway database credentials
3. Laravel project with database configured

### Fastest Method (Recommended)

```bash
# 1. Copy SQL file to project root
cp "dbujikom (4).sql" /Users/tanziljws/Documents/webgalerisyifa/

# 2. Update .env with Railway credentials
# Edit .env file with your Railway database credentials

# 3. Run seeder
cd /Users/tanziljws/Documents/webgalerisyifa
php artisan db:seed --class=ProductionDataSeeder
```

**Done!** ✨

---

## 🔧 Method 1: Laravel Seeder (Recommended)

### Why This Method?
- ✅ No need for MySQL client installation
- ✅ Handles internal Railway hosts automatically
- ✅ Auto-skips duplicate entries
- ✅ Shows progress bar
- ✅ Transaction safety
- ✅ Better error handling

### Step 1: Prepare SQL File

Copy your SQL file to one of these locations:
```bash
# Option 1: Project root (Recommended)
cp "dbujikom (4).sql" /Users/tanziljws/Documents/webgalerisyifa/

# Option 2: Database folder
cp "dbujikom (4).sql" /Users/tanziljws/Documents/webgalerisyifa/database/

# Option 3: Storage folder
cp "dbujikom (4).sql" /Users/tanziljws/Documents/webgalerisyifa/storage/
```

### Step 2: Update .env

Get your Railway database credentials from Railway dashboard:

```env
DB_CONNECTION=mysql
DB_HOST=your-railway-host.railway.app
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=your-password
```

**Important Notes:**
- Use the **PUBLIC URL** host, not `mysql.railway.internal`
- Railway usually provides public URL in format: `xxx.railway.app`
- Port is usually `3306`

### Step 3: Test Connection

```bash
php artisan migrate:status
```

If successful, you'll see migration table status.

### Step 4: Run Import

```bash
# Normal import (skip duplicates)
php artisan db:seed --class=ProductionDataSeeder

# Fresh import (delete all data first)
php artisan db:seed --class=ImportFromSqlSeeder --fresh
```

### Expected Output

```
🚀 Starting Production Data Import...
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
✅ Found SQL file: /Users/tanziljws/Documents/webgalerisyifa/dbujikom (4).sql
📖 Reading SQL file...
🧹 Cleaning SQL statements...
📝 Found 450 SQL statements to execute
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
⏳ Progress: [████████████████████████████████] 100% (450/450)
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📊 Import Summary:
   ✅ Success: 445
   ⚠️  Skipped: 5 (duplicates)
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
✨ Production data import completed successfully!
```

---

## 🖥️ Method 2: MySQL Client

### Prerequisites
- MySQL client installed
- Railway public URL credentials

### For macOS (Homebrew)

```bash
# Install MySQL client (if not installed)
brew install mysql-client

# Add to PATH
echo 'export PATH="/opt/homebrew/opt/mysql-client/bin:$PATH"' >> ~/.zshrc
source ~/.zshrc

# Verify installation
mysql --version
```

### Manual Import

```bash
# Using helper script
chmod +x railway-import.sh
./railway-import.sh
# Select option 2 (MySQL Client)

# OR manual command
mysql -h your-railway-host.railway.app \
      -P 3306 \
      -u root \
      -p \
      railway < "dbujikom (4).sql"
```

---

## ☁️ Method 3: Railway Shell

### Step 1: Install Railway CLI

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login
```

### Step 2: Link Project

```bash
cd /Users/tanziljws/Documents/webgalerisyifa
railway link
# Select your project
```

### Step 3: Upload and Import

```bash
# Option A: Direct import via Railway shell
railway run mysql -h mysql.railway.internal \
                  -u root \
                  -p$MYSQLPASSWORD \
                  railway < "dbujikom (4).sql"

# Option B: Use Laravel seeder via Railway
railway run php artisan db:seed --class=ProductionDataSeeder
```

---

## 🛠️ Helper Script Usage

### Interactive Menu

```bash
chmod +x railway-import.sh
./railway-import.sh
```

Menu options:
1. **Laravel Seeder** - Recommended method
2. **MySQL Client** - Direct import with mysql command
3. **Fresh Import** - Delete all data + import
4. **Update .env** - Automatically update Railway credentials
5. **Test Connection** - Verify database connectivity
6. **Exit**

---

## 🔍 Troubleshooting

### Error: "Connection refused"

**Problem:** Using internal host from local machine

**Solution:**
```bash
# ❌ Wrong (internal host)
DB_HOST=mysql.railway.internal

# ✅ Correct (public URL)
DB_HOST=containers-us-west-xxx.railway.app
```

Get public URL from Railway dashboard → Database → Settings → Public Networking

### Error: "SQL file not found"

**Solution:**
```bash
# Check file location
ls -la "dbujikom (4).sql"

# Copy to project root
cp "dbujikom (4).sql" /Users/tanziljws/Documents/webgalerisyifa/

# Or specify full path in seeder
php artisan db:seed --class=ImportFromSqlSeeder \
  --sql-file="/Users/tanziljws/Documents/dbujikom (4).sql"
```

### Error: "Duplicate entry"

**This is normal!** The seeder automatically skips duplicate entries.

If you want fresh import:
```bash
php artisan db:seed --class=ImportFromSqlSeeder --fresh
```

### Error: "MySQL command not found"

**Solution 1:** Use Laravel Seeder (no MySQL client needed)
```bash
php artisan db:seed --class=ProductionDataSeeder
```

**Solution 2:** Install MySQL client
```bash
# macOS
brew install mysql-client

# Add to PATH
export PATH="/opt/homebrew/opt/mysql-client/bin:$PATH"
```

### Error: "Access denied for user"

**Check credentials:**
```bash
# Test connection
php artisan tinker
> DB::connection()->getPdo();
```

If error, update .env with correct credentials from Railway.

### Error: "Table doesn't exist"

**Run migrations first:**
```bash
php artisan migrate
```

Then import data:
```bash
php artisan db:seed --class=ProductionDataSeeder
```

---

## 📚 FAQ

### Q: Should I use migration or seeder?

**A:** 
- **Migrations** = Database structure (tables, columns)
- **Seeders** = Database data (rows, content)

For importing SQL dump with both structure and data, use seeder.

### Q: Can I import without deleting existing data?

**A:** Yes! Default behavior skips duplicate entries.
```bash
php artisan db:seed --class=ProductionDataSeeder
```

### Q: How to delete all data and reimport?

**A:** Use fresh import:
```bash
php artisan db:seed --class=ImportFromSqlSeeder --fresh
```

### Q: Import failed halfway, how to resume?

**A:** The seeder uses transactions, so failed imports are rolled back. Just run again:
```bash
php artisan db:seed --class=ProductionDataSeeder
```

### Q: Can I import on Railway directly?

**A:** Yes, deploy the seeders to Railway and run:
```bash
railway run php artisan db:seed --class=ProductionDataSeeder
```

### Q: How to verify import success?

**A:** Check data:
```bash
php artisan tinker
> DB::table('users')->count();
> DB::table('foto')->count();
> DB::table('kategori')->count();
```

Compare with expected counts from your SQL file.

---

## 📊 Data Summary (from your SQL)

Your SQL file contains:
- **Users:** 17 records
- **Petugas (Admin):** 6 records
- **Kategori:** 12 records
- **Foto:** 94 records
- **Agendas:** 15 records
- **Informasi:** 11 records
- **Comments:** 8 records
- **Likes:** 75 records
- **Download Logs:** 7 records

---

## 🎯 Recommended Workflow

1. **Local Development:**
   ```bash
   # Use local database
   DB_HOST=127.0.0.1
   php artisan migrate
   php artisan db:seed --class=ProductionDataSeeder
   ```

2. **Deploy to Railway:**
   ```bash
   git push
   # Railway auto-deploys
   ```

3. **Import to Railway:**
   ```bash
   # Update .env with Railway credentials
   php artisan config:clear
   php artisan db:seed --class=ProductionDataSeeder
   ```

---

## 🆘 Need Help?

If you encounter issues:

1. Check Railway logs:
   ```bash
   railway logs
   ```

2. Test database connection:
   ```bash
   php artisan migrate:status
   ```

3. Verify SQL file location:
   ```bash
   ls -la "dbujikom (4).sql"
   ```

4. Run with verbose output:
   ```bash
   php artisan db:seed --class=ProductionDataSeeder -v
   ```

---

## ✅ Success Checklist

- [ ] SQL file copied to project root
- [ ] .env updated with Railway credentials
- [ ] Database connection tested
- [ ] Migrations run successfully
- [ ] Data imported via seeder
- [ ] Data verified in database

---

**Happy importing! 🚀**
