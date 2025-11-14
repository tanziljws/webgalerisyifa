# Galeri Sekolah - Installation Guide

## Deskripsi
Website galeri sekolah dengan fitur publik dan panel admin untuk mengelola konten galeri, kategori, dan informasi sekolah.

## Persyaratan Sistem
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL/MariaDB
- Web Server (Apache/Nginx)
- XAMPP/WAMP/LAMP

## Langkah Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd ujikom
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbujikom
DB_USERNAME=root
DB_PASSWORD=
```

### 4.1. Konfigurasi HTTPS (Untuk Production)
Untuk memastikan semua form dan URL menggunakan HTTPS, tambahkan di file `.env`:
```env
APP_URL=https://yourdomain.com
FORCE_HTTPS=true
APP_ENV=production
```
**Catatan:** Aplikasi akan otomatis memaksa HTTPS di production environment.

### 5. Import Database
- Buat database dengan nama `dbujikom`
- Import file `database_schema.sql` ke database
- Import file `database_seeder.sql` untuk data sample

### 6. Setup Storage
```bash
php artisan storage:link
```

### 7. Jalankan Aplikasi
```bash
php artisan serve
```

## Akses Aplikasi

### Website Publik
- URL: `http://localhost:8000`
- Menu: Beranda, Profil, Galeri, Kategori, Agenda, Login

### Panel Admin
- URL: `http://localhost:8000/admin/login`
- Username: `admin`
- Password: `password`

## Fitur Utama

### Publik (Guest)
- ✅ **Beranda** - Halaman utama dengan berita terkini, galeri, dan agenda
- ✅ **Profil** - Informasi lengkap tentang sekolah
- ✅ **Galeri** - Tampilan foto kegiatan sekolah
- ✅ **Kategori** - Filter konten berdasarkan kategori:
  - Ekstrakurikuler
  - Berita Terkini
  - Prestasi & Penghargaan
- ✅ **Agenda** - Jadwal kegiatan dengan filter:
  - Pensi
  - Transforkrab
  - P5
  - Moontour
  - Klasmeet
  - Lomba 17-an
- ✅ **Login** - Hanya untuk Admin

### Admin
- ✅ Login/Logout
- ✅ Dashboard dengan Statistik
- ✅ Manajemen Admin (CRUD Petugas)
- ✅ Data Foto/Galeri (CRUD)
- ✅ Kategori Galeri (CRUD)
- ✅ Manajemen Halaman (CRUD Profile)
- ✅ Tambah Foto
- ✅ Hapus Foto
- ✅ Update Profile

## Struktur Database

### Tabel Utama
- `kategori` - Kategori konten (Ekstrakurikuler, Berita Terkini, dll)
- `posts` - Post/artikel
- `profile` - Halaman profil sekolah
- `petugas` - Data admin/petugas
- `galery` - Galeri foto
- `foto` - Data foto

### Relasi
- `posts` → `kategori` (kategori_id)
- `posts` → `petugas` (petugas_id)
- `galery` → `posts` (post_id)
- `foto` → `galery` (galery_id)

## Kategori Konten

### 1. Ekstrakurikuler
- Kegiatan Pramuka
- Klub Robotik
- English Club
- Dan lainnya

### 2. Berita Terkini
- Penerimaan Siswa Baru
- Lomba Matematika
- Kunjungan Industri
- Dan lainnya

### 3. Prestasi & Penghargaan
- Juara Olimpiade Sains
- Penghargaan Adiwiyata
- Lomba Debat
- Dan lainnya

### 4. Galeri Sekolah
- Dokumentasi kegiatan
- Foto-foto acara
- Dokumentasi prestasi

### 5. Agenda Sekolah
- Pensi (Pentas Seni)
- Transforkrab (Transportasi Forklift Kreatif)
- P5 (Proyek Penguatan Profil Pelajar Pancasila)
- Moontour (Study Tour)
- Klasmeet (Class Meeting)
- Lomba 17-an

## Keamanan
- Middleware admin untuk proteksi route
- Password hashing dengan bcrypt
- Validasi input form
- CSRF protection
- Session management

## Teknologi yang Digunakan
- **Backend**: Laravel 11 (PHP)
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: MySQL
- **Architecture**: MVC Pattern

## Troubleshooting

### Error Database Connection
- Pastikan database `dbujikom` sudah dibuat
- Periksa konfigurasi database di `.env`
- Pastikan service MySQL berjalan

### Error Storage
- Jalankan `php artisan storage:link`
- Pastikan folder `storage/app/public` memiliki permission write

### Error 404
- Pastikan mod_rewrite Apache aktif
- Periksa file `.htaccess` di folder public

## Support
Untuk bantuan lebih lanjut, silakan hubungi developer atau buat issue di repository.
