<?php
session_start();

// Reuse global config and database via PDO
require_once __DIR__ . '/../core/config.php';
require_once __DIR__ . '/../core/db.php';

// Prepare redirect base URL for admin area (works regardless of BASE_URL)
// For /admin/login.php this resolves to '/admin/'
$adminBase = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/admin/login.php'), '/') . '/';

// Already logged in? Head straight to dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: ' . $adminBase . 'dashboard.php');
    exit;
}

// Only handle POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $adminBase . 'index.php');
    exit;
}

// Collect POST data safely
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    $_SESSION['error'] = 'Please provide both email and password.';
    header('Location: ' . $adminBase . 'index.php');
    exit;
}

try {
    $pdo = db();
    $stmt = $pdo->prepare('SELECT id, name, role, password FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        // Regenerate session ID to prevent fixation
        session_regenerate_id(true);
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        header('Location: ' . $adminBase . 'dashboard.php');
        exit;
    }
    // Invalid credentials
    $_SESSION['error'] = 'Invalid email or password.';
    header('Location: ' . $adminBase . 'index.php');
    exit;
} catch (Exception $e) {
    // Log error, but do not display sensitive info
    $_SESSION['error'] = 'An unexpected error occurred.';
    header('Location: ' . $adminBase . 'index.php');
    exit;
}
?>
