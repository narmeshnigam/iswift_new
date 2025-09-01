<?php
// Base URL
include __DIR__ . '/config.php';

// Compute active link by current PHP file name
$current = basename($_SERVER['PHP_SELF'] ?? '');
function is_active(string $file, string $current): string {
  return $current === $file ? 'active' : '';
}
?>
<!-- Toggle button -->
<button class="sidebar-toggle" aria-controls="sidebar" aria-expanded="false" onclick="toggleSidebar()">☰</button>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar" role="navigation" aria-label="Admin sidebar">
  <div>
    <div class="logo">
      <a href="<?= $BASE_URL ?>dashboard.php" aria-label="iSwift Admin Home">
        <img src="<?= $BASE_URL ?>assets/iSwift_logo.png" alt="iSwift Logo">
      </a>
    </div>

    <nav class="sidebar-nav">
      <a href="<?= $BASE_URL ?>dashboard.php"
         class="<?= is_active('dashboard.php', $current) ?>">Dashboard</a>

      <a href="<?= $BASE_URL ?>products/list.php"
         class="<?= is_active('list.php', $current) ?>">Products</a>

      <a href="<?= $BASE_URL ?>products/add.php"
         class="<?= is_active('add.php', $current) ?>">Add Product</a>

      <a href="<?= $BASE_URL ?>change_password.php"
         class="<?= is_active('change_password.php', $current) ?>">Change Password</a>
    </nav>
  </div>

  <div class="logout">
    <a href="<?= $BASE_URL ?>logout.php">Log out</a>
  </div>
</aside>
