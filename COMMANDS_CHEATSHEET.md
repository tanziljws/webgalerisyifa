# ⚡ Railway Import - Command Cheat Sheet

## 🎯 Most Common Commands

### Import Data (Recommended)
```bash
php artisan db:seed --class=ProductionDataSeeder
```

### Fresh Import (Delete All + Import)
```bash
php artisan db:seed --class=ImportFromSqlSeeder --fresh
```

### Interactive Menu
```bash
./railway-import.sh
```

### Update .env
```bash
./update-env.sh
```

### Run Diagnostics
```bash
./diagnose.sh
```

---

## 📦 Setup Commands

### Copy SQL File
```bash
cp "dbujikom (4).sql" /Users/tanziljws/Documents/webgalerisyifa/
```

### Test Database Connection
```bash
php artisan migrate:status
```

### Clear Config Cache
```bash
php artisan config:clear
```

---

## 🔍 Verification Commands

### Check Table Counts
```bash
php artisan tinker
> DB::table('users')->count();
> DB::table('foto')->count();
> DB::table('kategori')->count();
> exit
```

### Check Specific Tables
```bash
php artisan tinker --execute="echo 'Users: ' . DB::table('users')->count();"
php artisan tinker --execute="echo 'Photos: ' . DB::table('foto')->count();"
php artisan tinker --execute="echo 'Categories: ' . DB::table('kategori')->count();"
```

### List All Tables
```bash
php artisan tinker --execute="print_r(DB::select('SHOW TABLES'));"
```

---

## 🛠️ Troubleshooting Commands

### Full Diagnostics
```bash
./diagnose.sh
```

### Check .env Config
```bash
php artisan tinker --execute="echo 'Host: ' . config('database.connections.mysql.host');"
php artisan tinker --execute="echo 'Database: ' . config('database.connections.mysql.database');"
```

### Test Raw Connection
```bash
php artisan tinker --execute="try { DB::connection()->getPdo(); echo 'Connected!'; } catch (Exception \$e) { echo 'Failed: ' . \$e->getMessage(); }"
```

### View Laravel Logs
```bash
tail -f storage/logs/laravel.log
```

---

## 📁 File Management

### Check SQL File Location
```bash
ls -la "dbujikom (4).sql"
ls -la database/"dbujikom (4).sql"
```

### Check Seeder Files
```bash
ls -la database/seeders/ProductionDataSeeder.php
ls -la database/seeders/ImportFromSqlSeeder.php
```

### Make Scripts Executable
```bash
chmod +x railway-import.sh update-env.sh diagnose.sh
```

---

## 🔄 Railway CLI Commands

### Install Railway CLI
```bash
npm install -g @railway/cli
```

### Login to Railway
```bash
railway login
```

### Link Project
```bash
railway link
```

### Run Command on Railway
```bash
railway run php artisan migrate:status
railway run php artisan db:seed --class=ProductionDataSeeder
```

### View Railway Logs
```bash
railway logs
```

---

## 💾 Backup & Restore

### Backup Current .env
```bash
cp .env .env.backup.$(date +%Y%m%d_%H%M%S)
```

### Restore .env from Backup
```bash
cp .env.backup.20251113_120000 .env
php artisan config:clear
```

### Export Current Database
```bash
mysqldump -h $DB_HOST -P $DB_PORT -u $DB_USERNAME -p$DB_PASSWORD $DB_DATABASE > backup.sql
```

---

## 🎨 One-Liners

### Complete Setup
```bash
./update-env.sh && php artisan config:clear && php artisan db:seed --class=ProductionDataSeeder
```

### Diagnose + Import
```bash
./diagnose.sh && php artisan db:seed --class=ProductionDataSeeder
```

### Fresh Start
```bash
php artisan config:clear && php artisan db:seed --class=ImportFromSqlSeeder --fresh
```

### Quick Test
```bash
php artisan migrate:status && php artisan tinker --execute="echo DB::table('users')->count() . ' users found';"
```

---

## 📊 Expected Results

After successful import:

| Command | Expected Output |
|---------|----------------|
| `php artisan tinker --execute="echo DB::table('users')->count();"` | 17 |
| `php artisan tinker --execute="echo DB::table('foto')->count();"` | 94 |
| `php artisan tinker --execute="echo DB::table('kategori')->count();"` | 12 |
| `php artisan tinker --execute="echo DB::table('agendas')->count();"` | 15 |
| `php artisan tinker --execute="echo DB::table('informasi')->count();"` | 11 |

---

## 🚀 Quick Workflow

```bash
# 1. Diagnose setup
./diagnose.sh

# 2. Update .env (if needed)
./update-env.sh

# 3. Import data
php artisan db:seed --class=ProductionDataSeeder

# 4. Verify
php artisan tinker --execute="echo 'Users: ' . DB::table('users')->count();"
```

---

## 🔑 Environment Variables

### View Current Config
```bash
php artisan tinker --execute="
    echo 'DB_HOST: ' . env('DB_HOST') . PHP_EOL;
    echo 'DB_PORT: ' . env('DB_PORT') . PHP_EOL;
    echo 'DB_DATABASE: ' . env('DB_DATABASE') . PHP_EOL;
    echo 'DB_USERNAME: ' . env('DB_USERNAME') . PHP_EOL;
"
```

### Set Environment Variable (Temporary)
```bash
export DB_HOST=your-host.railway.app
export DB_PORT=3306
```

---

## 📖 Help Commands

### View Artisan Commands
```bash
php artisan list
php artisan list db
```

### View Seeder Help
```bash
php artisan db:seed --help
```

### Check PHP Version
```bash
php -v
```

### Check Laravel Version
```bash
php artisan --version
```

---

## 🎯 Production Deployment

### Deploy to Railway
```bash
git add .
git commit -m "Add production data import"
git push

# Then on Railway:
railway run php artisan db:seed --class=ProductionDataSeeder
```

### Run Migration + Seed
```bash
railway run php artisan migrate --seed
```

---

## 💡 Tips

- Always run `./diagnose.sh` first
- Use `--fresh` flag carefully (deletes all data!)
- Railway credentials must use PUBLIC URL
- Clear cache after .env changes: `php artisan config:clear`
- Check Railway logs if import fails: `railway logs`

---

**Print this page for quick reference! 📄**
