<?php
/**
 * Global configuration for the iSwift website.
 *
 * This file defines constants for the base URL, database connection
 * parameters and default timezone.  It attempts to detect whether the
 * application is running in a local development environment (localhost)
 * or production.  The `BASE_URL` constant is used by the helper
 * functions to generate absolute links throughout the site.
 */

// Detect host to determine environment
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$isLocal = in_array($host, ['localhost', '127.0.0.1'], true);

// Compute base path dynamically from the executing script so local subfolders work.
// Examples:
//  - http://localhost/iswift_new/index.php => BASE_URL '/iswift_new/'
//  - https://example.com/index.php         => BASE_URL '/'
if (!defined('BASE_URL')) {
    $script = $_SERVER['SCRIPT_NAME'] ?? '/';
    $basePath = rtrim(str_replace('\\', '/', dirname($script)), '/');
    $basePath = $basePath === '' ? '/' : ($basePath . '/');
    define('BASE_URL', $basePath);
}

// Database connection parameters
if (!defined('DB_HOST')) {
    define('DB_HOST', $isLocal ? 'localhost' : 'localhost');
}
if (!defined('DB_NAME')) {
    // Use a sensible default DB name for local development
    define('DB_NAME', $isLocal ? 'iswift' : 'u348991914_iswift');
}
if (!defined('DB_USER')) {
    define('DB_USER', $isLocal ? 'root' : 'u348991914_iswift');
}
if (!defined('DB_PASS')) {
    define('DB_PASS', $isLocal ? '' : 'Z@q@@Fu|fQ$3');
}

// Set default timezone for all date/time operations
date_default_timezone_set('Asia/Kolkata');
