# Honeybee Marketplace

A Laravel + MySQL + Blade marketplace for buying and selling locally. The UI uses Bootstrap 5 from its CDN; no frontend build is required.

## Features

- Browse active product and service listings with keyword, city, category, type, and price filters.
- Register, log in, and log out using the existing Laravel users table.
- Create listings with one optional image, edit or mark them sold, and delete your own listings.
- View listing details and contact a seller by email.
- Parent categories and subcategories populated by a seeder.
- Ownership checks, CSRF-protected forms, validation, password hashing, and pagination.

## Project notes

This repository already contains an older Laravel storefront. Marketplace code is isolated in `App\Marketplace` and uses `marketplace_categories` and `marketplace_listings` tables so it does not collide with existing storefront tables. The marketplace is served at `/`; the old storefront homepage remains available at `/storefront`.

## Setup

1. Install the PHP dependencies from the repository root:

   ```sh
   composer install
   ```

2. Configure `.env` with the MySQL database connection you intend to use. Ensure the existing Laravel `users` table is present before running the listings migration. On a clean database, create it with `php artisan migrate --path=database/migrations/2014_10_12_000000_create_users_table.php`. Do not run `migrate:fresh` against a database containing existing application data.

3. Run the two marketplace migrations (or run `php artisan migrate` when setting up a clean database and all existing migrations are intended):

   ```sh
   php artisan migrate --path=database/migrations/2026_11_23_000001_create_marketplace_categories_table.php
   php artisan migrate --path=database/migrations/2026_11_23_000002_create_marketplace_listings_table.php
   ```

4. Add the starter categories:

   ```sh
   php artisan db:seed --class=MarketplaceCategorySeeder
   ```

5. Enable public listing image URLs and start the application:

   ```sh
   php artisan storage:link
   php artisan serve
   ```

Open `http://127.0.0.1:8000`. Create an account, post a listing, then try the city and category filters.

## Main routes

| Route | Purpose |
| --- | --- |
| `/` | Browse/search listings |
| `/marketplace/listing/{id}` | Listing details |
| `/marketplace/register` | Create an account |
| `/marketplace/login` | Sign in |
| `/marketplace/listings/create` | Post an ad (signed in) |
| `/marketplace/my-listings` | Manage your ads (signed in) |

Category and listing schema changes are in `database/migrations`; the category seed data is in `database/seeds/MarketplaceCategorySeeder.php`.
