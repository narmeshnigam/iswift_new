# Proposed Sitemap for iSwift Website

The following URL tree outlines all public pages for the new iSwift website. Each clean URL is relative to the site root. Dynamic slugs are indicated in curly braces.

## Top‑Level Pages

* `/` – Home page
* `/products` – Product listing with filters and pagination
* `/product/{slug}` – Individual product detail page (slug generated from product name)
* `/solutions` – Landing page for all solutions/services
* `/solution/{slug}` – Individual solution detail page (e.g. smart‑lighting, smart‑locks)
* `/projects` – Listing of case studies
* `/project/{slug}` – Individual project detail page
* `/learn` – Blog/knowledge hub index
* `/category/{slug}` – Product category listings (e.g. locks, doorbells, mesh‑wifi)
* `/homeowners` – Informational page for homeowners
* `/professionals` – Partnerships page for architects/designers/builders
* `/book-demo` – Demo booking form
* `/service-areas` – Listing of supported cities in Delhi NCR
* `/service-area/{slug}` – Individual service area page (delhi, noida, gurugram, ghaziabad, faridabad, greater‑noida)
* `/contact` – Contact information and enquiry form
* `/pricing` – Indicative pricing and quotation page
* `/testimonials` – Client testimonials
* `/faqs` – Frequently asked questions
* `/warranty-support` – Warranty & support information
* `/about` – About iSwift (mission, values, team)
* `/privacy` – Privacy policy
* `/terms` – Terms of use

## Error Pages

* `/404.php` – Not found error page
* `/500.php` – Internal server error page

## Administrative Routes

These are accessible under `/admin/` and require authentication:

* `/admin/index.php` – Login page
* `/admin/login.php` – Login processor (POST)
* `/admin/dashboard.php` – Admin dashboard
* `/admin/products/list.php` – List products (CRUD)
* `/admin/products/add.php` – Add product form
* `/admin/products/edit.php` – Edit product form
* `/admin/change_password.php` – Change password form
* `/admin/logout.php` – Logout

Future administrative sections (to be built) will include CRUD interfaces for categories, projects, solutions, testimonials, FAQs, blog posts, partnership leads, demo bookings, media manager and settings.