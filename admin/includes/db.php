<?php
// Provide a PDO connection for admin pages, reusing the site's core DB helper.

// Load global configuration and PDO helper
require_once __DIR__ . '/../../core/config.php';
require_once __DIR__ . '/../../core/db.php';

// Try to get a PDO instance. Never hard-fail the page here; callers can handle null.
$pdo = null;
try {
    $pdo = db();
} catch (Throwable $e) {
    // Swallow connection errors here; pages that require DB will handle absence of $pdo
    $pdo = null;
}
?>
