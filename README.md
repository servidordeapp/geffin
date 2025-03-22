# Welcome to the Saas Monolith Boilerplate.

This project is a quick start to speed up your next amazing project.

## Stack

- [PHP](https://www.php.net/) >= 8.3
- [Laravel](https://laravel.com/) >= 12
- [Inertia](https://inertiajs.com/)
- [Vue 3](https://vuejs.org/)
- [Tailwind CSS](https://tailwindcss.com/) (For styling)
- [Sentry](https://sentry.io/) (For error monitoring)
- [Asaas](https://www.asaas.com/) (For payments)


## Features included

- :heavy_check_mark: Multitenancy Single Database
- [ ] Billing with [Asaas](https://www.asaas.com/desenvolvedores)
- :heavy_check_mark: Error Monitoring by Sentry
- :heavy_check_mark: Auditing on Every Tenant Model
    - Get knowledge about what happens to your data and when it happens
- [ ] Admin Dashboard to:
    - Manage clients
    - View invoices
    - Billing plans
- [ ] API Login
- [ ] API Logout
- [ ] API Forgot Password
- [ ] API Reset Password

## How to configure

```
php artisan sentry:publish --dsn=https://examplePublicKey@o0.ingest.sentry.io/0
```

Where you can found at [Sentry Docs](https://docs.sentry.io/platforms/php/guides/laravel/#configure) when your account logged in.
