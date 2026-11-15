# Ecommerce Website

This repository is currently an **incomplete Laravel application scaffold**, not a runnable eCommerce storefront.

## Repository status

The default branch contains Laravel dependency manifests and project configuration, but the application directories required to run Laravel are absent. In particular, there is no `app/`, `bootstrap/`, `config/`, `routes/`, `resources/`, `database/`, `public/`, or `tests/` directory in the inspected repository tree.

The tracked dependency manifests describe:

- Laravel Framework `^9.2` and PHP `^8.0.2`
- Laravel Jetstream, Sanctum, Tinker and Livewire
- Laravel Mix 6, Tailwind CSS 3 and Alpine.js 3

These versions describe the existing scaffold; they are not a recommendation to deploy it as-is.

## Recovery and modernization

The `recovery/secure-baseline` branch is being used to investigate the project and establish a safe baseline without changing `master`.

See [the project audit and recovery plan](docs/PROJECT_AUDIT.md) for verified findings, limitations and the proposed implementation sequence.

## Security

- Never commit `.env` or credentials.
- Copy `.env.example` to `.env` only in a local development environment.
- Configure secrets through environment variables or a secret manager.
- If credentials were ever committed, deleting the file from the current branch is not sufficient: rotate them and consider removing them from Git history.

## License

The repository currently contains a Laravel scaffold whose original license and application ownership should be confirmed before redistribution or deployment.
