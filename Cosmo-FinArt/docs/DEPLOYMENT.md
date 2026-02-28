# Deployment Runbook

## 1. Build Artifacts

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

## 2. Environment

Set production-safe values:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://your-domain`
- `SESSION_SECURE_COOKIE=true`
- `FILESYSTEM_DISK=public` (or `s3` with full S3 configuration)

## 3. Database and Storage

```bash
php artisan migrate --force
php artisan storage:link
```

## 4. Runtime Caches

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 5. Queue and Scheduler

- Run queue worker via Supervisor:

```ini
[program:cosmo-queue]
command=php /var/www/cosmo-finart/artisan queue:work --tries=3 --timeout=90
autostart=true
autorestart=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/cosmo-finart/storage/logs/queue.log
stopwaitsecs=3600
```

- Cron entry:

```cron
* * * * * cd /var/www/cosmo-finart && php artisan schedule:run >> /dev/null 2>&1
```

## 6. Post-Deploy Smoke Tests

Check:

1. `/`
2. `/about`
3. `/products`
4. `/products/{active-slug}`
5. `/admin/login`
6. Upload flow from Filament admin

## 7. Go / No-Go Checklist

- `php artisan test` is green.
- No debug mode in production.
- Super admin account exists and non-admin cannot access `/admin`.
- Caches built successfully.
- Queue worker and scheduler active.
