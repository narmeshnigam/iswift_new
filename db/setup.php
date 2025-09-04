<?php
// db/setup.php
// Creates the local database if missing and runs migrations with sample data.

declare(strict_types=1);

// Load config constants (DB_HOST/DB_NAME/DB_USER/DB_PASS)
require_once __DIR__ . '/../core/config.php';

function out($msg) { echo $msg . PHP_EOL; }

$host = DB_HOST;
$db   = DB_NAME;
$user = DB_USER;
$pass = DB_PASS;

try {
    // 1) Connect to MySQL server without specifying DB to create it if needed
    $dsnServer = 'mysql:host=' . $host . ';charset=utf8mb4';
    $pdoServer = new PDO($dsnServer, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // 2) Create database if not exists (UTF8MB4)
    $pdoServer->exec("CREATE DATABASE IF NOT EXISTS `{$db}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    out("Database ensured: {$db}");

    // 3) Connect to the target DB
    $dsnDb = 'mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8mb4';
    $pdo = new PDO($dsnDb, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // 4) If legacy 'products' table exists, ensure required columns exist (for idempotency)
    $needColumns = [
        'sku' => 'ALTER TABLE products ADD COLUMN sku VARCHAR(100) NULL AFTER slug',
        'short_desc' => 'ALTER TABLE products ADD COLUMN short_desc TEXT NULL AFTER sku',
        'description' => 'ALTER TABLE products ADD COLUMN description MEDIUMTEXT NULL AFTER short_desc',
        'price' => 'ALTER TABLE products ADD COLUMN price DECIMAL(12,2) NOT NULL DEFAULT 0.00 AFTER description',
        'sale_price' => 'ALTER TABLE products ADD COLUMN sale_price DECIMAL(12,2) NULL AFTER price',
        'status' => "ALTER TABLE products ADD COLUMN status ENUM('draft','published','archived') NOT NULL DEFAULT 'draft' AFTER sale_price",
        'stock' => 'ALTER TABLE products ADD COLUMN stock INT UNSIGNED NOT NULL DEFAULT 0 AFTER status',
        'brochure_url' => 'ALTER TABLE products ADD COLUMN brochure_url VARCHAR(255) NULL AFTER stock',
        'meta_title' => 'ALTER TABLE products ADD COLUMN meta_title VARCHAR(255) NULL AFTER brochure_url',
        'meta_description' => 'ALTER TABLE products ADD COLUMN meta_description VARCHAR(255) NULL AFTER meta_title',
    ];
    $tables = $pdo->query("SHOW TABLES LIKE 'products'")->fetchAll(PDO::FETCH_COLUMN);
    if ($tables) {
        $cols = $pdo->query('SHOW COLUMNS FROM products')->fetchAll(PDO::FETCH_COLUMN);
        foreach ($needColumns as $col => $ddl) {
            if (!in_array($col, $cols, true)) {
                try { $pdo->exec($ddl); out("Added column products.{$col}"); } catch (Throwable $e) { /* ignore */ }
            }
        }
    }

    // 5) Ensure other related tables have required columns if they already exist
    $ensureTableCols = function (PDO $pdo, string $table, array $cols): void {
        $exists = $pdo->query("SHOW TABLES LIKE '" . str_replace("'", "''", $table) . "'")->fetchAll(PDO::FETCH_COLUMN);
        if (!$exists) return;
        $existingCols = $pdo->query('SHOW COLUMNS FROM ' . $table)->fetchAll(PDO::FETCH_COLUMN);
        foreach ($cols as $col => $ddl) {
            if (!in_array($col, $existingCols, true)) {
                try { $pdo->exec($ddl); out("Added column {$table}.{$col}"); } catch (Throwable $e) { /* ignore */ }
            }
        }
    };

    $ensureTableCols($pdo, 'product_specs', [
        'label' => 'ALTER TABLE product_specs ADD COLUMN label VARCHAR(150) NOT NULL AFTER product_id',
        'value' => 'ALTER TABLE product_specs ADD COLUMN value VARCHAR(255) NOT NULL AFTER label',
        'sort_order' => 'ALTER TABLE product_specs ADD COLUMN sort_order INT UNSIGNED NOT NULL DEFAULT 0 AFTER value',
    ]);
    $ensureTableCols($pdo, 'product_features', [
        'feature' => 'ALTER TABLE product_features ADD COLUMN feature TEXT NOT NULL AFTER product_id',
        'sort_order' => 'ALTER TABLE product_features ADD COLUMN sort_order INT UNSIGNED NOT NULL DEFAULT 0 AFTER feature',
    ]);
    $ensureTableCols($pdo, 'product_faqs', [
        'question' => 'ALTER TABLE product_faqs ADD COLUMN question VARCHAR(255) NOT NULL AFTER product_id',
        'answer' => 'ALTER TABLE product_faqs ADD COLUMN answer TEXT NOT NULL AFTER question',
        'sort_order' => 'ALTER TABLE product_faqs ADD COLUMN sort_order INT UNSIGNED NOT NULL DEFAULT 0 AFTER answer',
    ]);
    $ensureTableCols($pdo, 'product_images', [
        'path' => 'ALTER TABLE product_images ADD COLUMN path VARCHAR(255) NOT NULL AFTER product_id',
        'is_primary' => 'ALTER TABLE product_images ADD COLUMN is_primary TINYINT(1) NOT NULL DEFAULT 0 AFTER path',
        'sort_order' => 'ALTER TABLE product_images ADD COLUMN sort_order INT UNSIGNED NOT NULL DEFAULT 0 AFTER is_primary',
    ]);
    $ensureTableCols($pdo, 'categories', [
        'slug' => 'ALTER TABLE categories ADD COLUMN slug VARCHAR(100) NOT NULL UNIQUE AFTER name',
        'description' => 'ALTER TABLE categories ADD COLUMN description TEXT NULL AFTER slug',
        'updated_at' => 'ALTER TABLE categories ADD COLUMN updated_at TIMESTAMP NULL DEFAULT NULL AFTER created_at',
    ]);

    // 6) Run migrations in order
    $migrationsDir = __DIR__ . '/migrations';
    if (!is_dir($migrationsDir)) {
        throw new RuntimeException('Migrations directory not found: ' . $migrationsDir);
    }

    // Basic tracking table
    $pdo->exec('CREATE TABLE IF NOT EXISTS _migrations (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        filename VARCHAR(255) NOT NULL UNIQUE,
        applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

    $applied = $pdo->query('SELECT filename FROM _migrations')->fetchAll(PDO::FETCH_COLUMN) ?: [];
    $files = glob($migrationsDir . '/*.sql');
    sort($files, SORT_NATURAL | SORT_FLAG_CASE);

    foreach ($files as $file) {
        $name = basename($file);
        if (in_array($name, $applied, true)) {
            out("Skipping already applied: {$name}");
            continue;
        }

        $sql = file_get_contents($file);
        if ($sql === false) {
            throw new RuntimeException('Failed to read migration: ' . $file);
        }

        out("Applying migration: {$name}");
        // Split on semicolons at line ends; simple but fine for our schema
        $stmts = array_filter(array_map('trim', preg_split('/;\s*\r?\n/', $sql)));
        try {
            foreach ($stmts as $stmt) {
                if ($stmt === '') continue;
                // Remove inline comment lines that start with --
                $stmt = preg_replace('/^\s*--.*$/m', '', $stmt);
                $stmt = trim($stmt);
                if ($stmt === '') continue;
                $pdo->exec($stmt);
            }
            $ins = $pdo->prepare('INSERT INTO _migrations (filename) VALUES (?)');
            $ins->execute([$name]);
            out("Applied: {$name}");
        } catch (Throwable $e) {
            throw $e;
        }
    }

    out('All migrations complete.');

    // 7) Seed a default admin user if none exists
    try {
        $cnt = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
        if ($cnt === 0) {
            $name = 'Administrator';
            $email = 'admin@iswift.local';
            $plain = 'admin123';
            $ins = $pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (:n,:e,:p,\'admin\')');
            $ins->execute([':n' => $name, ':e' => $email, ':p' => $plain]);
            out('Seeded default admin (plain password): ' . $email . ' / admin123');
        }

        // Ensure requested admin user exists
        $email2 = 'narmesh@iswift.in';
        $exists = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE email = 'narmesh@iswift.in'")->fetchColumn();
        if ($exists === 0) {
            $plain2 = 'admin123';
            $ins2 = $pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (:n,:e,:p,\'admin\')');
            $ins2->execute([':n' => 'Narmesh', ':e' => $email2, ':p' => $plain2]);
            out('Seeded admin user (plain password): ' . $email2);
        }
    } catch (Throwable $e) {
        // Ignore if table not present or other non-critical issues
    }
} catch (Throwable $e) {
    http_response_code(500);
    out('Setup failed: ' . $e->getMessage());
    exit(1);
}

out('Setup finished successfully.');
