# 📋 **DOKUMENTASI SETUP ADMIN - JEEP MERAPI ADVENTURE**

## 🔐 **Cara Membuat Akun Admin Baru**

### **Metode 1: Menggunakan Artisan Tinker (Recommended)**

```bash
# Masuk ke direktori project
cd /path/to/jeep-merapi-adventure

# Buka Laravel Tinker
php artisan tinker

# Buat user admin baru
User::create([
    'name' => 'Admin Jeep Merapi',
    'email' => 'admin@jeepmerapiadventure.com',
    'password' => Hash::make('password123'),
    'email_verified_at' => now(),
]);

# Keluar dari tinker
exit
```

### **Metode 2: Menggunakan Endpoint Register (Temporary)**

**⚠️ PENTING: Hanya untuk setup awal, disable setelah selesai!**

1. **Enable register routes** di `routes/auth.php`:
   ```php
   // Uncomment baris berikut:
   Route::get('register', [RegisteredUserController::class, 'create'])
               ->name('register');
   Route::post('register', [RegisteredUserController::class, 'store']);
   ```

2. **Akses halaman register**:
   ```
   http://yoursite.com/register
   ```

3. **Isi form registrasi**:
   - Name: Admin Jeep Merapi
   - Email: admin@jeepmerapiadventure.com
   - Password: [password yang aman]
   - Confirm Password: [ulangi password]

4. **⚠️ WAJIB: Comment kembali routes register** setelah selesai:
   ```php
   // Route::get('register', [RegisteredUserController::class, 'create'])
   //             ->name('register');
   // Route::post('register', [RegisteredUserController::class, 'store']);
   ```

### **Metode 3: Database Seeder**

1. **Buat seeder**:
   ```bash
   php artisan make:seeder AdminUserSeeder
   ```

2. **Edit file** `database/seeders/AdminUserSeeder.php`:
   ```php
   <?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\User;
   use Illuminate\Support\Facades\Hash;

   class AdminUserSeeder extends Seeder
   {
       public function run()
       {
           User::create([
               'name' => 'Admin Jeep Merapi',
               'email' => 'admin@jeepmerapiadventure.com',
               'password' => Hash::make('admin123'),
               'email_verified_at' => now(),
           ]);
       }
   }
   ```

3. **Jalankan seeder**:
   ```bash
   php artisan db:seed --class=AdminUserSeeder
   ```

---

## 🛡️ **Keamanan Admin Panel**

### **Features yang Dimatikan:**
- ❌ **Register Routes** - Mencegah registrasi publik
- ❌ **Forgot Password** - Mencegah reset password tidak sah
- ❌ **Email Verification** - Simplified untuk admin internal

### **Features yang Aktif:**
- ✅ **Login dengan Show/Hide Password**
- ✅ **Remember Me**
- ✅ **Session Management**
- ✅ **CSRF Protection**
- ✅ **Route Protection dengan Middleware Auth**

### **Akses Admin:**
- **URL Login**: `http://yoursite.com/login`
- **Link Footer**: Klik titik (•) setelah copyright
- **Dashboard**: `http://yoursite.com/admin/dashboard`

---

## 🔄 **Cara Update Password Admin**

### **Via Tinker:**
```bash
php artisan tinker

# Cari user admin
$admin = User::where('email', 'admin@jeepmerapiadventure.com')->first();

# Update password
$admin->update(['password' => Hash::make('password_baru_123')]);

exit
```

### **Via Database:**
```sql
-- Masuk ke database
-- Update password (hash bcrypt untuk 'newpassword123')
UPDATE users
SET password = '$2y$12$xyz...'
WHERE email = 'admin@jeepmerapiadventure.com';
```

---

## 📝 **Default Admin Credentials (Development)**

```
Email: admin@jeepmerapiadventure.com
Password: admin123
```

**⚠️ WAJIB GANTI** password default untuk production!

---

## 🚀 **Quick Setup Commands**

```bash
# Setup lengkap admin
php artisan tinker
User::create(['name' => 'Admin Jeep Merapi', 'email' => 'admin@jeepmerapiadventure.com', 'password' => Hash::make('admin123'), 'email_verified_at' => now()]);
exit

# Test login
curl -X POST http://localhost:8000/login \
  -d "email=admin@jeepmerapiadventure.com" \
  -d "password=admin123" \
  -d "_token=$(curl -s http://localhost:8000/login | grep '_token' | cut -d'"' -f4)"
```

---

## 📞 **Support**

Jika mengalami masalah setup admin:
1. Pastikan database sudah migrate: `php artisan migrate`
2. Clear cache: `php artisan cache:clear`
3. Check logs: `storage/logs/laravel.log`

**Setup berhasil jika bisa login ke** `http://yoursite.com/admin/dashboard` 🎯
