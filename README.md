# Form & Function — Ecommerce Website

A Laravel 13 storefront foundation rebuilt on a dedicated modernization branch.

## Current scope

- Product catalog with basic search and pagination
- Product detail pages
- Session-backed cart with stock-aware quantity limits
- Sample catalog data for local development
- Feature tests for catalog visibility and cart behavior

Checkout, payments, customer accounts, administration, shipping, taxes and production deployment are not complete yet.

## Requirements

- PHP 8.3+
- Composer 2
- Node.js 22.12+ recommended
- SQLite for quick local setup (or a supported production database)

## Setup (Windows PowerShell)

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item -ItemType File -Force database/database.sqlite
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Open http://127.0.0.1:8000. Run `npm run dev` in a second terminal for frontend hot reload.

## Setup (macOS / Linux)

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

## Tests and code style

```bash
php artisan test
vendor/bin/pint --test
composer audit
npm audit
```

## Security

Never commit `.env`, payment credentials, API keys, or customer data. Configure production secrets through your hosting platform's secret manager. Use a payment provider's hosted checkout or tokenized SDK; never store raw card data.

## Project history

The original public repository contained Laravel dependency manifests but no application source directories. Its tracked `.env` was removed from the recovery branch, but historical commits may still contain it. Rotate any credentials that may have been present. See [the audit and recovery record](docs/PROJECT_AUDIT.md).

The original `master` branch remains untouched. Development is taking place on `modernize/laravel13-storefront`.
