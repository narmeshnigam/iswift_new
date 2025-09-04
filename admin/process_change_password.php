<?php
session_start();
require_once __DIR__ . '/../core/config.php';
require_once __DIR__ . '/../core/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'admin/index.php');
    exit;
}

$current = $_POST['current_password'] ?? '';
$new     = $_POST['new_password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if ($new === '') {
    $_SESSION['cp_error'] = 'New password cannot be empty.';
    header('Location: ' . BASE_URL . 'admin/change_password.php');
    exit;
}
if ($new !== $confirm) {
    $_SESSION['cp_error'] = 'New password and confirmation do not match.';
    header('Location: ' . BASE_URL . 'admin/change_password.php');
    exit;
}

try {
    $pdo = db();
    $stmt = $pdo->prepare('SELECT password FROM users WHERE id = :id LIMIT 1');
    $stmt->execute([':id' => (int)$_SESSION['user_id']]);
    $row = $stmt->fetch();
    if (!$row) {
        $_SESSION['cp_error'] = 'User not found.';
        header('Location: ' . BASE_URL . 'admin/change_password.php');
        exit;
    }
    $stored = (string)$row['password'];
    // Accept both plain and old hashed current passwords
    $matches = ($stored === $current) || ((str_starts_with($stored, '$2') || str_starts_with($stored, '$argon2')) && password_verify($current, $stored));
    if (!$matches) {
        $_SESSION['cp_error'] = 'Your current password is incorrect.';
        header('Location: ' . BASE_URL . 'admin/change_password.php');
        exit;
    }

    // Store new password in plain text as requested (no hashing)
    $up = $pdo->prepare('UPDATE users SET password = :p WHERE id = :id');
    $up->execute([':p' => $new, ':id' => (int)$_SESSION['user_id']]);

    $_SESSION['cp_success'] = 'Password updated successfully.';
    header('Location: ' . BASE_URL . 'admin/change_password.php');
    exit;
} catch (Throwable $e) {
    $_SESSION['cp_error'] = 'Unexpected error updating password.';
    header('Location: ' . BASE_URL . 'admin/change_password.php');
    exit;
}
?>

