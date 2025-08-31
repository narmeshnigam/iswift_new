# Release Notes for iSwift Website Revamp

## Version 1.0 (2025‑08‑28)

This release represents a complete overhaul of the iSwift public website and a partial refactor of the admin system. Key highlights include:

### New Features

* **Responsive, modern design** inspired by the approved UI sample with improved navigation, typography and colour palette.
* **Clean URL structure and SEO‑ready pages** for products, solutions, projects, categories, service areas, blog hub and informational content (homeowners, professionals, pricing, testimonials, FAQs, warranty & support, about, contact, privacy and terms).
* **Template engine** using PHP partials and helpers to centralise the header, footer and asset loading.
* **Global configuration** and PDO database helper for secure and consistent DB access.
* **Database migration script** defining tables for users, products, categories, solutions, projects, posts, FAQs and testimonials.
* **Sample JSON‑LD snippets** for organisation, products, services and local business pages for structured data markup.
* **Robots.txt and sitemap.xml** to guide search engine indexing.
* **Analytics placeholders** for GA4 and GTM, along with a specification of recommended events.

### Improvements

* Replaced the old hard‑coded admin login with secure password hashing and PDO prepared statements.
* Added 404 and 500 error pages with friendly messaging.
* Refactored the CSS using variables and improved responsive behavior for navigation and grids.
* Added call‑to‑action banners and contact details in the footer.
* Centralised configuration for base URL and database credentials, enabling seamless environment switching.

### Known Limitations & Next Steps

* Admin CRUD interfaces for categories, products, solutions, projects and blog posts have not yet been fully implemented. Existing admin pages continue to use MySQLi; these need to be migrated to PDO and integrated with CSRF protection.
* The contact and booking forms currently do not persist submissions. Back‑end processing, validation and email notifications are required.
* Search functionality on products page supports only basic filtering; advanced faceted search and pagination require further development.
* The `admin_user_guide` and `qa_matrix` are pending preparation.

Please refer to `docs/bugfix_log.md` for a detailed change log.