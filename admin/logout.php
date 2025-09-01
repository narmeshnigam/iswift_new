<?php
session_start();
session_unset();
session_destroy();
include __DIR__ . '/includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logged Out – iSwift ERP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="2;url=<?= $BASE_URL ?>index.php">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/style.css">
</head>
<body class="logout-page">
  <main class="auth-container">
    <section class="auth-card logout-card" role="status" aria-live="polite">
      <h1 class="logout-title">You’ve been logged out</h1>
      <p class="logout-sub">
        Redirecting to login page…
        <a href="<?= $BASE_URL ?>index.php">Click here</a> if not redirected.
      </p>
    </section>
  </main>
</body>
</html>
