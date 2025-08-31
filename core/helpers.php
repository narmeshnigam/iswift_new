<?php
/**
 * General helper functions for the iSwift site.
 */

require_once __DIR__ . '/config.php';

/**
 * Escape a string for safe HTML output.
 *
 * @param string|null $str
 * @return string
 */
function esc(?string $str): string
{
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Generate an absolute URL for a given path relative to the site root.
 *
 * @param string $path
 * @return string
 */
function url(string $path = ''): string
{
    $path = ltrim($path, '/');
    return BASE_URL . $path;
}

/**
 * Generate an asset URL relative to the `assets` directory.  This helper
 * prefixes the path with the site base URL and `assets/`.
 *
 * @param string $path
 * @return string
 */
function asset(string $path): string
{
    $path = ltrim($path, '/');
    return url('assets/' . $path);
}

/**
 * Include a partial template from the `partials` directory.  Variables
 * defined in `$data` become available in the included file.  Partials
 * should not output closing `</body>` or `</html>` tags unless they are
 * responsible for wrapping the entire page.
 *
 * @param string $name
 * @param array $data
 */
function partial(string $name, array $data = []): void
{
    extract($data, EXTR_SKIP);
    $file = __DIR__ . '/../partials/' . $name . '.php';
    if (is_file($file)) {
        include $file;
    }
}