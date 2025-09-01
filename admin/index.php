<?php
session_start();
include __DIR__ . '/includes/config.php';

// If the user is already logged in, send them to the dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: {$BASE_URL}dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login – iSwift ERP</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Scoped login stylesheet -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/style.css">
</head>
<body class="login-page">
  <main class="auth-container">
    <section class="auth-card">
      <div class="auth-header">
        <img class="logo" src="<?= $BASE_URL ?>assets/iSwift_logo.png" alt="iSwift ERP">
        <h1 class="title">Admin Login</h1>
        <p class="subtitle">Sign in to continue to your dashboard</p>
        <?php if (!empty($_SESSION['error'])): ?>
          <p class="error" style="color:#c00;"><?= htmlspecialchars($_SESSION['error']) ?></p>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
      </div>

      <form action="login.php" method="POST" class="auth-form" novalidate>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" name="email" id="email" placeholder="you@example.com" required autocomplete="username">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="••••••••" required autocomplete="current-password">
        </div>

        <button type="submit" class="btn">Login</button>
      </form>
    </section>
  </main>
</body>
</html>
