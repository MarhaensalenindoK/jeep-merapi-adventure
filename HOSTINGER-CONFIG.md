# 🔧 Hostinger Specific Configuration

## .htaccess untuk Document Root (jika tidak menggunakan symlink)

RewriteEngine On

# Redirect ke folder public Laravel
RewriteCond %{REQUEST_URI} !^/public/
RewriteRule ^(.*)$ /public/$1 [L,QSA]

# Handle Laravel Pretty URLs
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /public/index.php [L,QSA]

## PHP Configuration (untuk .htaccess atau php.ini)

# Memory Limit
php_value memory_limit 512M

# Upload Limits
php_value upload_max_filesize 64M
php_value post_max_size 64M
php_value max_execution_time 300

# Error Reporting (Production)
php_value display_errors Off
php_value log_errors On

## Database Configuration Template

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_jeep_merapi
DB_USERNAME=u123456789_admin
DB_PASSWORD=your_secure_password
```

## Email Configuration untuk Hostinger

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=admin@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="admin@yourdomain.com"
MAIL_FROM_NAME="Jeep Merapi Adventure"
```

## Cron Jobs untuk Laravel Scheduler (jika diperlukan)

```
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

## File Permissions Commands

```bash
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod 644 .env
```

## Quick Commands Cheat Sheet

```bash
# Deploy from Git
git pull origin main && bash deploy.sh

# Clear all caches
php artisan optimize:clear

# Check application status
php artisan about

# Run migrations
php artisan migrate --force

# Generate new APP_KEY
php artisan key:generate --force

# Create admin user (if needed)
php artisan tinker
User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => Hash::make('password')]);
```
