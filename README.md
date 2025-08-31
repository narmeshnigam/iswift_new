# iSwift Website

Local setup (XAMPP)
- Requirements: PHP 8+, MySQL/MariaDB, XAMPP or similar.
- Clone or place the repo in your web root (e.g., `c:/xampp/htdocs/iswift_new`).
- Ensure MySQL is running.
- Create and seed the database: run `php db/setup.php`. This will:
  - Create the `iswift` database if missing.
  - Apply the schema in `db/migrations/001_create_schema.sql` with sample data.
  - Seed a default admin user if none exists.

Admin login
- URL: `/admin/`
- Email: `admin@iswift.local`
- Password: `admin123`

Serving locally
- Using PHP’s built-in server: `php -S 127.0.0.1:8787 -t .`
- Then open `http://127.0.0.1:8787/` in your browser.

Notes
- App auto-detects base URL and works from any subfolder.
- Uploads stored under `uploads/products/`.
