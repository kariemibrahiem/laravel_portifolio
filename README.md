# Laravel Portfolio

## Overview

This project is a personal portfolio platform built with Laravel. It serves two main purposes:

1. Public portfolio website for presenting experience, projects, skills, tech stack, and contact details.
2. Admin dashboard for managing the portfolio content, admin users, roles, partners, collaborators, and project records.

The public site is rendered with Blade views and static assets. The back office uses a Laravel admin template with CRUD screens and permission-based access control.

## What The Project Does

### Public website

The public side is loaded from `routes/front.php` and currently includes:

- `/` Home page
- `/about`
- `/projects`
- `/blog`
- `/contact`

The homepage pulls data from the database and shows:

- About section
- Experience timeline
- Portfolio/projects gallery
- Skills section
- Techs section
- Contact details and map

The home page controller is [HomeController.php](/d:/projects/laravel_portifolio/app/Http/Controllers/Web/HomeController.php).

### Admin dashboard

The admin side is loaded from `routes/web.php` inside a localized route group and protected with `auth:admin`.

Main managed modules:

- Admins
- Users
- Roles
- Partners
- Collaborations
- Projects
- Settings

The dashboard entry route is `/admin`.

### API

The API is loaded from `routes/api.php` and uses Laravel Sanctum for authenticated routes.

Current API areas:

- User login/register/OTP flows
- Admin login/register-style flows
- Authenticated user profile update/delete
- Authenticated admin CRUD endpoints

## Core Stack

- PHP `^8.2`
- Laravel `^11.41`
- Laravel Sanctum
- Spatie Laravel Permission
- Mcamara Laravel Localization
- Yajra DataTables
- SweetAlert / Toastr
- Vite
- Tailwind CSS
- Bootstrap 5
- React is installed in frontend dependencies, but the current public/admin implementation is primarily Blade-based

## Project Structure

- `app/Http/Controllers/Web`
  Public website controllers
- `app/Http/Controllers/Admin`
  Admin controllers and dashboard pages
- `app/Http/Controllers/v1`
  API controllers
- `app/Services/Admin`
  Business logic for admin CRUD modules
- `app/Models`
  Eloquent models
- `routes/front.php`
  Public website routes
- `routes/web.php`
  Admin web routes
- `routes/api.php`
  API routes
- `resources/views/web`
  Public site Blade views
- `resources/views/content`
  Admin dashboard Blade views
- `database/migrations`
  Database schema
- `database/seeders`
  Default seeded content and access data

## Main Data Model

### Public content tables

- `experiences`
  Career timeline items
- `portfolios`
  Portfolio/project cards shown on the homepage
- `skills`
  Skills with either image icons or Font Awesome icons
- `techs`
  Technology/competency records

### Supporting admin tables

- `partners`
  Client/partner records related to projects
- `collaborators`
  People attached to projects
- `collaborator_project`
  Pivot table linking collaborators to portfolio items

### Access/auth tables

- `admins`
  Dashboard administrators
- `users`
  Application users
- Spatie permission tables
  Roles and permissions for admin authorization
- Sanctum personal access token tables

## Public Page Flow

The homepage action in [HomeController.php](/d:/projects/laravel_portifolio/app/Http/Controllers/Web/HomeController.php) loads:

- `Experience::orderBy('sort_order')`
- `Portfolio::orderBy('sort_order')`
- `Skill::orderBy('sort_order')`
- `Tech::orderBy('sort_order')`

It then renders [home.blade.php](/d:/projects/laravel_portifolio/resources/views/web/pages/home.blade.php), which displays:

- Fixed side navigation
- Personal branding/about text
- Experience cards
- Portfolio image grid with external project links
- Skills icons
- Tech cards
- Contact block and embedded map

## Admin Architecture

The admin area uses a controller + service pattern.

Example:

- [ProjectController.php](/d:/projects/laravel_portifolio/app/Http/Controllers/Admin/ProjectController.php)
- [ProjectService.php](/d:/projects/laravel_portifolio/app/Services/Admin/ProjectService.php)
- [BaseService.php](/d:/projects/laravel_portifolio/app/Services/BaseService.php)

Typical responsibilities:

- Controller receives request
- Form request validates input
- Service handles CRUD logic
- Blade views render create/edit/index screens
- Yajra DataTables powers AJAX listing tables

## Routing

### Route loading

Routes are registered in [RouteServiceProvider.php](/d:/projects/laravel_portifolio/app/Providers/RouteServiceProvider.php):

- `routes/api.php` with `/api` prefix
- `routes/web.php` for admin and auth web routes
- `routes/front.php` for public website routes

### Localization

`routes/web.php` wraps admin routes with:

- `LaravelLocalization::setLocale()`

Custom locale handling is also added in [Kernel.php](/d:/projects/laravel_portifolio/app/Http/Kernel.php) through:

- `SetLocale` middleware
- localization middleware aliases from `mcamara/laravel-localization`

## Authentication And Authorization

### Admin auth

- Admin pages use guard `admin`
- Roles/permissions are handled by Spatie
- Seeded role: `super_admin`

### API auth

- Sanctum protects authenticated API routes

### Default seeded accounts

Created by [DatabaseSeeder.php](/d:/projects/laravel_portifolio/database/seeders/DatabaseSeeder.php):

- Admin email: `admin@admin.com`
- Admin password: `admin`
- User email: `user@email.com`
- User password: `user`

Note: the models hash passwords automatically, so plaintext values in seeders become hashed on save.

## Seeded Demo Content

The seeders add starter content for:

- Experience history
- Portfolio projects
- Skills
- Tech stack items
- Admin role/permissions

Portfolio examples include:

- Edarat
- Travel
- Mawhebtac
- Elmazon
- Clinizone CRM
- Atabe
- Hub Spare Part
- Zakat
- ESOIEgypt

## Packages In Use

Important backend packages from `composer.json`:

- `laravel/framework`
- `laravel/sanctum`
- `spatie/laravel-permission`
- `mcamara/laravel-localization`
- `yajra/laravel-datatables-oracle`
- `realrashid/sweet-alert`
- `yoeunes/toastr`
- `buglinjo/laravel-webp`
- `pion/laravel-chunk-upload`
- `vimeo/laravel`
- `google/apiclient`

Important frontend packages from `package.json`:

- `vite`
- `tailwindcss`
- `bootstrap`
- `jquery`
- `react`
- `react-dom`
- `react-router-dom`

## Setup

### Requirements

- PHP 8.2+
- Composer
- Node.js + npm
- MySQL or another supported Laravel database

### Installation

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

If you are developing locally with Vite:

```bash
npm run dev
```

## Environment Notes

Make sure these are configured in `.env`:

- `APP_NAME`
- `APP_URL`
- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

If API authentication is used heavily, also verify Sanctum-related session/cookie settings for your environment.

## Frontend Assets

The project contains a mix of:

- Legacy static web assets under `public/web`
- Admin template assets under `public/assets`
- Vite-managed assets in `resources/css` and `resources/js`

There is also an older `webpack.mix.js` file in the repository, but the active package scripts are Vite-based through `package.json`.

## Translation Behavior

The helper `trns()` in [helper.php](/d:/projects/laravel_portifolio/app/Http/Hepler/helper.php) dynamically writes missing translation keys into `resources/lang/en/file.php`.

That means:

- New strings can be auto-added during runtime
- The language file may change while browsing/admin usage
- This is convenient, but it also means translations are not fully static

## Important Implementation Notes

### 1. `Project` model uses `portfolios` table

The model [Project.php](/d:/projects/laravel_portifolio/app/Models/Project.php) is configured as:

- `protected $table = 'portfolios';`

So in practice:

- Admin "projects" are stored in the `portfolios` table
- Public portfolio items and admin project records are the same data source

This is intentional in the current implementation, but the naming can confuse future maintenance.

### 2. Public `/projects` route has redirect logic

`routes/front.php` checks whether a named route `projects.index` exists and may redirect if needed; otherwise it falls back to the front controller method.

In the current route set, admin project routes are actually named with `Backprojects.*`, so the fallback is what matters.

### 3. AppServiceProvider custom view composer is commented out

In [AppServiceProvider.php](/d:/projects/laravel_portifolio/app/Providers/AppServiceProvider.php), a global `View::composer('*', ...)` block exists but is commented.

So currently no global `userProvider` variable is injected into all views.

### 4. Some repository code appears reused from broader systems

Files such as the global helper and base service contain utilities unrelated to this portfolio app. They do not block the portfolio features, but they indicate the codebase was adapted from a larger starter/admin system.

## Testing

The repository includes PHPUnit/Pest setup and some default auth/profile tests under `tests/`, but the app currently looks more customized than the shipped starter tests.

Run tests with:

```bash
php artisan test
```

## Recommended Next Cleanup

If this project will continue growing, the highest-value cleanup items are:

1. Rename project/portfolio concepts consistently across models, routes, services, and views.
2. Remove dead starter-template pages and unused helper/service code.
3. Replace hardcoded profile/contact text with database-driven settings.
4. Decide whether Vite is the only asset pipeline and remove old Mix leftovers.
5. Add focused feature tests for public homepage rendering and admin CRUD flows.

## Quick Summary

This is a Laravel 11 portfolio application with:

- A public personal portfolio website
- A localized admin dashboard
- Role/permission-based admin access
- CRUD management for portfolio content and related entities
- Sanctum-based API endpoints for auth and user/admin actions

The main business purpose of the project is to showcase a developer profile and portfolio while giving the owner an internal admin panel to manage the displayed content.
