# Cosmo-FinArt

Laravel 11 + Filament 4 project for the Cosmo FinArt website.

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8+ (or compatible)

## Local Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run build
php artisan serve
```

## Super Admin Seeding

`DatabaseSeeder` no longer creates test users by default.

Use these variables to seed a super admin account:

- `SEED_SUPER_ADMIN_NAME`
- `SEED_SUPER_ADMIN_EMAIL`
- `SEED_SUPER_ADMIN_PASSWORD`
- `ALLOW_PRODUCTION_ADMIN_SEED` (must be `true` to seed in production)

## Useful Commands

```bash
php artisan test
php artisan route:list
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Deployment and Environment Policy

- Deployment runbook: `docs/DEPLOYMENT.md`
- Environment policy: `docs/ENVIRONMENTS.md`
