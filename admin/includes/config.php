<?php
// Reuse the global configuration from the public site.
// This file sets up $BASE_URL for admin and ensures DB constants
// are defined. The global `core/config.php` defines BASE_URL,
// DB_HOST, DB_NAME, DB_USER and DB_PASS.

require_once __DIR__ . '/../../core/config.php';

// The admin section uses the same base URL as the site
$BASE_URL = BASE_URL;

// Ensure DB constants are available (already defined in core/config.php)
// No further action required here.
