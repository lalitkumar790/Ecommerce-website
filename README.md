# Ecommerce Website

A Laravel 13 storefront foundation rebuilt on a dedicated modernization branch.

## Current scope

- Product catalog with search and pagination
- Product detail pages
- Session-backed cart with stock-aware quantity limits
- Seed data for local development
- Feature tests for catalog and cart behavior

Checkout, payment processing, customer accounts, administration, inventory workflows, shipping, tax and production deployment are not complete yet.

## Requirements

- PHP 8.3+
- Composer 2
- Node.js compatible with the Vite toolchain
- SQLite for quick local setup (or a supported production database)

## Setup

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

On Windows PowerShell, create the SQLite file with:

```powershell
New-Item -ItemType File -Force database/database.sqlite
```

Open http://127.0.0.1:8000. Run `npm run dev` in a second terminal for hot reload.

## Tests

```bash
php artisan test
```

## Security

Never commit `.env`, payment credentials, API keys, or customer data. Configure production secrets through the hosting platform's secret manager. Use a payment provider's hosted checkout or tokenized SDK; never store raw card data.

## Project status

This is a new foundation because the original repository history contains no application source directories. The original default branch remains untouched while the recovery pull request is reviewed.
