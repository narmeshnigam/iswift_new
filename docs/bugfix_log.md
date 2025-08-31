# Bug Fix Log

This log records significant changes, fixes and improvements applied during the refactoring and enhancement of the iSwift website. It complements the audit and fix plan documents.

## 2025‑08‑28

* **Global structure overhaul** – Added a `core` directory with configuration (`config.php`), database helper (`db.php`), CSRF helper (`csrf.php`) and general helper functions (`helpers.php`). This centralises configuration and ensures consistent use of PDO with prepared statements.
* **New design and layout** – Implemented modern header and footer partials with responsive navigation, CTA sections and social links. Added a site‑wide CSS (`assets/css/style.css`) and JavaScript (`assets/js/main.js`) based on the approved UI sample. Replaced hard‑coded inline styles with CSS variables.
* **Home page** – Rebuilt `index.php` with hero section, solutions preview and demo banner. Added call‑to‑action buttons and improved typography.
* **Products listing and details** – Created `products.php` with filtering, search and pagination using PDO. Implemented `product-details.php` to display gallery, specifications, features, FAQs and related items. Added image thumbnails and JS for gallery switching.
* **New public pages** – Added skeleton pages for Solutions, individual Solution, Projects, Project details, Learn hub, Homeowners, Professionals (Partnerships), Contact, Book Demo, Service Areas and individual service area pages, Pricing, Testimonials, FAQs, Warranty & Support, About, Privacy Policy, Terms of Use, 404 and 500 error pages. Each page uses the new header/footer and includes placeholder content, ready for CMS integration.
* **Admin login** – Rewrote `admin/login.php` to use PDO and password hashing (`password_verify`) instead of plain‑text comparison. Added session regeneration and basic error handling. Config now reuses global constants.
* **Database migration** – Added `db/migrations/001_create_schema.sql` defining tables for users, categories, products, images, specs, FAQs, projects, solutions, testimonials, FAQs, posts and more. This serves as the foundation for the upcoming admin CMS.
* **Sitemap and docs** – Generated `docs/sitemap_proposed.md` with the new URL structure and `docs/analytics_events.md` outlining GA4/GTM events. Created placeholders for analytics integration.

## Ongoing

* Remaining tasks include implementing CRUD operations for categories, products, projects, solutions, testimonials and blog posts in the admin panel; adding CSRF protection to all admin forms; implementing login rate limiting; and finalising the SEO research and JSON‑LD scripts.