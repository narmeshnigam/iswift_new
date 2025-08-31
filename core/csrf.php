<?php
/**
 * Simple CSRF protection functions.
 *
 * The CSRF token is stored in the session under `_csrf_token`.  Use
 * `csrf_field()` to output a hidden input in your forms and call
 * `verify_csrf()` on POST requests to ensure the provided token matches
 * the one stored in the session.  If verification fails, execution
 * should halt and an error should be displayed or the user should be
 * redirected.
 */

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

/**
 * Generate (or retrieve) the CSRF token for the current session.
 *
 * @return string
 */
function csrf_token(): string
{
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}

/**
 * Output a hidden CSRF token input element.
 */
function csrf_field(): void
{
    echo '<input type="hidden" name="_csrf_token" value="' . esc(csrf_token()) . '">';
}

/**
 * Verify the CSRF token on POST requests.  Call this at the start of
 * any script handling a form submission.  If the token is missing or
 * does not match the session token, the function will exit and show an
 * error page.
 */
function verify_csrf(): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $posted = $_POST['_csrf_token'] ?? '';
        $stored = $_SESSION['_csrf_token'] ?? '';
        if (!hash_equals($stored, $posted)) {
            http_response_code(400);
            echo 'Invalid CSRF token';
            exit;
        }
    }
}