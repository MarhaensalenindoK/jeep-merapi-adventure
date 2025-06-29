# 🚀 Panduan Deployment Jeep Merapi Adventure ke Hostinger Premium Web Hosting

## 📋 Checklist Persiapan

### ✅ Persiapan Selesai
- [x] Project Laravel sudah siap
- [x] Assets sudah di-build untuk production
- [x] .env.example sudah dikonfigurasi untuk production
- [x] Nomor telepon dan alamat sudah diupdate
- [x] Semua fitur sudah testing dan berjalan baik

---

## 🔧 LANGKAH 1: Setup Database di Hostinger

1. **Login ke hPanel Hostinger**
   - Masuk ke https://hpanel.hostinger.com
   - Pilih domain website Anda

2. **Buat Database MySQL**
   - Di hPanel, cari menu **"MySQL Databases"**
   - Klik **"Create Database"**
   - Buat database dengan nama: `jeep_merapi_adventure`
   - Catat informasi berikut:
     ```
     DB_HOST: localhost
     DB_DATABASE: [nama_database_yang_dibuat]
     DB_USERNAME: [username_yang_dibuat]
     DB_PASSWORD: [password_yang_dibuat]
     ```

---

## 🔧 LANGKAH 2: Setup Git Deployment di Hostinger

### Option A: Git Deployment (Rekomendasi)

1. **Akses Git di hPanel**
   - Di hPanel, cari menu **"Git"** atau **"Git Version Control"**
   - Klik **"Create Repository"**

2. **Connect GitHub Repository**
   - Repository URL: `https://github.com/[username]/jeep-merapi-adventure.git`
   - Branch: `main` atau `master`
   - Target directory: `public_html` (untuk domain utama) atau `public_html/subdomain`

3. **Setup Auto Deploy**
   - Enable **"Auto Deploy"**
   - Set branch: `main` atau `master`

### Option B: Manual Upload via File Manager

1. **Export Project dari GitHub**
   - Download repository sebagai ZIP
   - Extract di komputer lokal

2. **Upload via File Manager**
   - Di hPanel, buka **"File Manager"**
   - Upload semua file KECUALI folder `node_modules` dan `.env`
   - Pastikan file `index.php` ada di folder `public_html`

---

## 🔧 LANGKAH 3: Konfigurasi Environment Production

1. **Buat File .env di Hostinger**
   - Via File Manager atau Terminal, buat file `.env` di root project
   - Copy isi dari `.env.example` dan sesuaikan:

```env
APP_NAME="Jeep Merapi Adventure"
APP_ENV=production
APP_KEY=base64:your_app_key_here
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=1440

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=your_email@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_email@yourdomain.com"
MAIL_FROM_NAME="Jeep Merapi Adventure"
```

2. **Generate APP_KEY**
   - Via Terminal Hostinger atau SSH:
   ```bash
   php artisan key:generate
   ```

---

## 🔧 LANGKAH 4: Setup Composer dan Dependencies

1. **Install Composer Dependencies**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

2. **Set File Permissions**
   ```bash
   chmod -R 775 storage
   chmod -R 775 bootstrap/cache
   ```

---

## 🔧 LANGKAH 5: Database Migration dan Seeding

1. **Run Migrations**
   ```bash
   php artisan migrate --force
   ```

2. **Seed Database (Opsional)**
   ```bash
   php artisan db:seed --force
   ```

---

## 🔧 LANGKAH 6: Laravel Optimization untuk Production

1. **Cache Configuration**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Clear Development Caches**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

---

## 🔧 LANGKAH 7: Setup Domain dan SSL

1. **Domain Configuration**
   - Pastikan domain pointing ke server Hostinger
   - Jika subdomain, buat subdomain di hPanel

2. **SSL Certificate**
   - Di hPanel, cari menu **"SSL/TLS"**
   - Enable **"Free SSL Certificate"**
   - Tunggu aktivasi (5-15 menit)

3. **Force HTTPS (Opsional)**
   - Di hPanel, enable **"Force HTTPS Redirect"**

---

## 🔧 LANGKAH 8: Setup Document Root (Penting!)

Laravel menggunakan folder `public` sebagai document root. Ada beberapa cara:

### Option A: Symlink (Rekomendasi)
```bash
# Hapus folder public_html default
rm -rf public_html

# Buat symlink ke folder public Laravel
ln -s /path/to/your/laravel/public public_html
```

### Option B: .htaccess Redirect
Buat file `.htaccess` di root `public_html`:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### Option C: Copy Public Files
Copy semua isi folder `public` ke `public_html` dan update path di `index.php`:
```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

---

## 🔧 LANGKAH 9: Testing dan Validasi

1. **Test Website**
   - Akses domain website
   - Test halaman utama, paket tour, blog, galeri
   - Test admin login
   - Test form contact

2. **Check Database Connection**
   ```bash
   php artisan tinker
   DB::connection()->getPdo();
   ```

3. **Check Laravel Status**
   ```bash
   php artisan about
   ```

---

## 🚨 Troubleshooting Common Issues

### Issue: 500 Internal Server Error
**Solusi:**
1. Check file permissions (775 untuk storage dan bootstrap/cache)
2. Check .env configuration
3. Run `php artisan config:clear`
4. Check error logs di hPanel

### Issue: Database Connection Failed
**Solusi:**
1. Verify database credentials di .env
2. Check database host (biasanya `localhost`)
3. Pastikan database sudah dibuat di hPanel

### Issue: CSS/JS Not Loading
**Solusi:**
1. Check asset paths di blade template
2. Run `npm run build` untuk regenerate assets
3. Check APP_URL di .env

### Issue: Missing APP_KEY
**Solusi:**
```bash
php artisan key:generate
```

---

## 📝 Maintenance Commands

### Update Code dari GitHub
```bash
git pull origin main
composer install --optimize-autoloader --no-dev
npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Clear All Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

### Backup Database
```bash
mysqldump -u username -p database_name > backup.sql
```

---

## 🎯 Final Checklist

- [ ] Database berhasil terkoneksi
- [ ] Website dapat diakses via domain
- [ ] SSL certificate aktif (https://)
- [ ] Halaman admin dapat diakses dan login berhasil
- [ ] Fitur CRUD paket tour berfungsi
- [ ] Fitur upload galeri berfungsi
- [ ] Blog dan CKEditor berfungsi
- [ ] Form contact berfungsi
- [ ] WhatsApp links berfungsi dengan nomor baru
- [ ] Google Maps menampilkan lokasi yang benar
- [ ] Performance website optimal

---

## 📞 Support

Jika mengalami kesulitan deployment, hubungi:
- **Hostinger Support**: https://support.hostinger.com
- **Laravel Documentation**: https://laravel.com/docs

---

**🎉 Selamat! Website Jeep Merapi Adventure siap online!**
