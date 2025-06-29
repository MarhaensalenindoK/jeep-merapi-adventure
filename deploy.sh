#!/bin/bash

# 🚀 Jeep Merapi Adventure - Production Deployment Script
# Untuk dijalankan di server Hostinger setelah git pull

echo "🚀 Starting Jeep Merapi Adventure Deployment..."

# 1. Install/Update Composer Dependencies
echo "📦 Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

# 2. Generate APP_KEY jika belum ada
if [ ! -f .env ]; then
    echo "⚙️  Creating .env file..."
    cp .env.example .env
    php artisan key:generate --force
fi

# 3. Set File Permissions
echo "🔐 Setting file permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# 4. Clear old caches
echo "🧹 Clearing old caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 5. Run Database Migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# 6. Cache untuk Production
echo "⚡ Caching for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Optimize Application
echo "🎯 Optimizing application..."
php artisan optimize

echo "✅ Deployment completed successfully!"
echo "🌐 Website: https://yourdomain.com"
echo "🔧 Admin: https://yourdomain.com/admin"

# Optional: Show application status
echo "📊 Application Status:"
php artisan about
