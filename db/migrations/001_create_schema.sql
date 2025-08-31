-- Migration script to create the database schema for iSwift CMS

-- Users
CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','editor') NOT NULL DEFAULT 'admin',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Categories
CREATE TABLE IF NOT EXISTS categories (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  slug VARCHAR(100) NOT NULL UNIQUE,
  description TEXT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

-- Products (aligned with site code)
CREATE TABLE IF NOT EXISTS products (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  category_id INT UNSIGNED NULL,
  name VARCHAR(150) NOT NULL,
  slug VARCHAR(150) NOT NULL UNIQUE,
  sku VARCHAR(100) NULL,
  short_desc TEXT NULL,
  description MEDIUMTEXT NULL,
  price DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  sale_price DECIMAL(12,2) NULL,
  status ENUM('draft','published','archived') NOT NULL DEFAULT 'draft',
  stock INT UNSIGNED NOT NULL DEFAULT 0,
  brochure_url VARCHAR(255) NULL,
  meta_title VARCHAR(255) NULL,
  meta_description VARCHAR(255) NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at DATETIME NULL,
  CONSTRAINT fk_products_category
    FOREIGN KEY (category_id) REFERENCES categories(id)
    ON DELETE SET NULL ON UPDATE CASCADE
);

-- Product images
CREATE TABLE IF NOT EXISTS product_images (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  product_id INT UNSIGNED NOT NULL,
  path VARCHAR(255) NOT NULL,
  is_primary TINYINT(1) NOT NULL DEFAULT 0,
  sort_order INT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_pimages_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Product specifications (label/value)
CREATE TABLE IF NOT EXISTS product_specs (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  product_id INT UNSIGNED NOT NULL,
  label VARCHAR(150) NOT NULL,
  value VARCHAR(255) NOT NULL,
  sort_order INT UNSIGNED NOT NULL DEFAULT 0,
  CONSTRAINT fk_pspecs_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Product features (bulleted list)
CREATE TABLE IF NOT EXISTS product_features (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  product_id INT UNSIGNED NOT NULL,
  feature TEXT NOT NULL,
  sort_order INT UNSIGNED NOT NULL DEFAULT 0,
  CONSTRAINT fk_pfeatures_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Product FAQs
CREATE TABLE IF NOT EXISTS product_faqs (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  product_id INT UNSIGNED NOT NULL,
  question VARCHAR(255) NOT NULL,
  answer TEXT NOT NULL,
  sort_order INT UNSIGNED NOT NULL DEFAULT 0,
  CONSTRAINT fk_pfaqs_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Projects
CREATE TABLE IF NOT EXISTS projects (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  slug VARCHAR(200) NOT NULL UNIQUE,
  city VARCHAR(100) NOT NULL,
  description TEXT,
  outcome TEXT,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Project gallery
CREATE TABLE IF NOT EXISTS project_images (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  project_id INT UNSIGNED NOT NULL,
  file_path VARCHAR(255) NOT NULL,
  sort_order INT UNSIGNED NOT NULL DEFAULT 0,
  CONSTRAINT fk_projimg_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);

-- Solutions (services offered)
CREATE TABLE IF NOT EXISTS solutions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  slug VARCHAR(150) NOT NULL UNIQUE,
  hero VARCHAR(255) DEFAULT NULL,
  body TEXT,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Solution benefits
CREATE TABLE IF NOT EXISTS solution_benefits (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  solution_id INT UNSIGNED NOT NULL,
  benefit TEXT NOT NULL,
  CONSTRAINT fk_sbenefits_solution FOREIGN KEY (solution_id) REFERENCES solutions(id) ON DELETE CASCADE
);

-- Testimonials
CREATE TABLE IF NOT EXISTS testimonials (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  city VARCHAR(100) NOT NULL,
  rating TINYINT UNSIGNED DEFAULT NULL,
  text TEXT NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- FAQs (global)
CREATE TABLE IF NOT EXISTS faqs (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  question VARCHAR(255) NOT NULL,
  answer TEXT NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Learn posts (blog)
CREATE TABLE IF NOT EXISTS posts (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  slug VARCHAR(200) NOT NULL UNIQUE,
  category VARCHAR(100) NOT NULL,
  excerpt TEXT,
  content MEDIUMTEXT,
  author VARCHAR(100) DEFAULT NULL,
  published_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Seed data (minimal)
INSERT INTO categories (name, slug, description) VALUES
  ('Smart Locks', 'smart-locks', 'Secure, keyless entry locks with PIN and app control')
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT INTO products (category_id, name, slug, sku, short_desc, description, price, sale_price, status, stock, meta_title, meta_description)
SELECT c.id, 'Sample Smart Lock', 'sample-smart-lock', 'DEMO-001', 'A sleek, secure smart lock demo item.',
       'This is a sample product created by the migration to help you test pages without adding content manually.',
       14999, 12999, 'published', 10, 'Sample Smart Lock — iSwift', 'Sample product used as a placeholder.'
FROM categories c WHERE c.slug = 'smart-locks'
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- Optional: a few specs/features/faqs for the sample product
INSERT INTO product_specs (product_id, label, value, sort_order)
SELECT p.id, s.label, s.value, s.sort_order FROM (
  SELECT 'Material' AS label, 'Aluminium Alloy' AS value, 1 AS sort_order
  UNION ALL SELECT 'Battery', 'AA x 4', 2
) s
JOIN products p ON p.slug = 'sample-smart-lock'
ON DUPLICATE KEY UPDATE value = VALUES(value);

INSERT INTO product_features (product_id, feature, sort_order)
SELECT p.id, f.feature, f.sort_order FROM (
  SELECT 'Secure PIN access' AS feature, 1 AS sort_order
  UNION ALL SELECT 'Mobile app control', 2
) f
JOIN products p ON p.slug = 'sample-smart-lock';

INSERT INTO product_faqs (product_id, question, answer, sort_order)
SELECT p.id, q.question, q.answer, q.sort_order FROM (
  SELECT 'Does it work offline?' AS question, 'Yes, PIN and key access continue to work.' AS answer, 1 AS sort_order
) q
JOIN products p ON p.slug = 'sample-smart-lock';
