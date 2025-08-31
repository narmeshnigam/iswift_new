# iSwift Website Admin User Guide

This guide provides a high‑level overview of the admin section for the revamped iSwift website. Use this document until a more comprehensive PDF guide is produced.

## Logging In

Navigate to `/admin` and log in with your email and password. Passwords are hashed and stored securely. On successful authentication, you will be redirected to the dashboard. If you forget your password, contact the technical team—self‑service password reset is not yet implemented.

## Dashboard

The dashboard displays key statistics about products and categories. Use the left sidebar to navigate between modules:

* **Products → List** – View, edit or delete existing products.
* **Products → Add** – Add a new product with name, slug, category, price, description, images, specifications and FAQs.
* **Change Password** – Update your login password.

Future releases will add modules for categories, solutions, projects, testimonials, FAQs, blog posts and settings.

## Managing Products

To create or edit products:

1. Go to **Products → Add** or **Products → List** and choose **Edit**.
2. Provide a unique slug (lowercase letters and hyphens) to identify the product in URLs.
3. Select the appropriate category and set the price. You can leave the price blank if it should not be displayed.
4. Upload multiple images. They will be resized and stored in `/uploads/products/`.
5. Enter short and long descriptions, specifications (key/value pairs), features and FAQs.
6. Save your changes. The product will appear on the public site.

## Security Notes

* Always log out after you finish working. A **Logout** link is provided in the sidebar.
* Do not share your account credentials with anyone else. Each admin should have a unique login.
* The admin panel uses CSRF protection and password hashing, but make sure to follow security best practices.

## Support

For technical support or to request additional features, contact **hi@iswift.in**.