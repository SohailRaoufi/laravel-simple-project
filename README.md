# Getting Started

Follow these steps to set up and run the project:

## 1. Install Dependencies

Install all PHP dependencies using Composer:

```bash
composer install
```

## 2. Configure Environment

Copy the example environment file and update your database settings in `.env`:

```bash
cp .env.example .env
```

Edit the `.env` file and set your database credentials:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

## 3. Run Migrations

Create the database tables:

```bash
php artisan migrate
```

## 4. Seed the Database

Populate the database with sample data:

```bash
php artisan db:seed
```

### Sample Credentials

After seeding, you can log in using the following sample credentials:

-   **Email:** `test@gmail.com`
-   **Password:** `123`

These credentials are created by the database seeder. You can modify them in the seeder file if needed.

## 5. Start the Development Server

Serve the application locally:

```bash
php artisan serve
```

Your application should now be running at [http://localhost:8000](http://localhost:8000).
