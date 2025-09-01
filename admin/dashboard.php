<?php
session_start();
include_once 'includes/config.php';
if (!isset($_SESSION['user_id'])) {
  header("Location: {$BASE_URL}index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard – iSwift ERP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/style.css">
</head>
<body class="sidebar-layout dashboard-page">
  <?php include __DIR__ . '/includes/nav.php'; ?>

  <main class="main-content dashboard-content">
    <header class="page-head">
      <h1>Welcome to iSwift Website Admin Section</h1>
      <p class="sub">This is the website dashboard. It allows you to manage website content, and keep it updated.</p>
    </header>

    <!-- Ready-to-wire KPI cards (no logic added) -->
    <section class="kpi-grid" aria-label="Quick stats">
      <article class="card kpi">
        <h4>Total Products</h4>
        <div class="value" data-field="products_total">—</div>
      </article>
      <article class="card kpi">
        <h4>Active Categories</h4>
        <div class="value" data-field="categories_total">—</div>
      </article>
      <article class="card kpi">
        <h4>Last Update</h4>
        <div class="value" data-field="last_update">—</div>
      </article>
    </section>

    <!-- Quick links (static) -->
    <section class="quick-actions" aria-label="Quick actions">
      <a class="qa-btn" href="<?= $BASE_URL ?>products/list.php">Manage Products</a>
      <a class="qa-btn ghost" href="<?= $BASE_URL ?>products/add.php">Add New Product</a>
      <a class="qa-btn ghost" href="<?= $BASE_URL ?>change_password.php">Change Password</a>
    </section>
  </main>

  <script src="<?= $BASE_URL ?>assets/nav.js"></script>
</body>
</html>
