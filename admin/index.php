<?php include __DIR__ . '/includes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login – iSwift ERP</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Scoped login stylesheet -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>admin/assets/style.css">
</head>
<body class="login-page">
  <main class="auth-container">
    <section class="auth-card">
      <div class="auth-header">
        <img class="logo" src="<?= $BASE_URL ?>admin/assets/iSwift_logo.png" alt="iSwift ERP">
        <h1 class="title">Admin Login</h1>
        <p class="subtitle">Sign in to continue to your dashboard</p>
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
