<?php
/**
 * Database connection helper.
 *
 * Returns a singleton PDO instance configured using constants
 * defined in `core/config.php`.  The connection is created lazily
 * on first use.  Any fatal error during connection will throw an
 * exception; callers should catch and handle as appropriate.
 */

require_once __DIR__ . '/config.php';

/**
 * Get a PDO connection.
 *
 * @return PDO
 * @throws PDOException on connection failure
 */
function db(): PDO
{
    static $pdo;
    if ($pdo instanceof PDO) {
        return $pdo;
    }
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    return $pdo;
}