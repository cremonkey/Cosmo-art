# Environment Policy

## Local

- `APP_ENV=local`
- `APP_DEBUG=true`
- Use local database and local storage.
- Super admin seeding can use local fallback values.

## Staging

- `APP_ENV=staging`
- `APP_DEBUG=false`
- Production-like database/storage.
- Seed super admin only through explicit env values.

## Production

- `APP_ENV=production`
- `APP_DEBUG=false`
- `SESSION_SECURE_COOKIE=true`
- HTTPS-only URLs.
- Never seed demo or test users.
- `ALLOW_PRODUCTION_ADMIN_SEED=true` only for controlled first-time bootstrap.

## Sensitive Variables

Always set through secret manager / secure deployment variables:

- `APP_KEY`
- `DB_PASSWORD`
- `MAIL_PASSWORD`
- `AWS_ACCESS_KEY_ID`
- `AWS_SECRET_ACCESS_KEY`
- `CURATOR_GLIDE_TOKEN`
- `SEED_SUPER_ADMIN_PASSWORD`
