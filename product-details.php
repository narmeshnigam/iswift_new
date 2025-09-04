<?php
// Product details page (shared UI)

require_once __DIR__ . '/core/helpers.php';

/* DB bootstrap */
$pdo = $pdo ?? null;
$cfg = __DIR__ . '/admin/includes/config.php';
$dbf = __DIR__ . '/admin/includes/db.php';
if (is_file($cfg)) require_once $cfg;
if (is_file($dbf)) require_once $dbf;
if (!($pdo instanceof PDO)) {
    $host = defined('DB_HOST') ? DB_HOST : ($DB_HOST ?? ($config['db']['host'] ?? '127.0.0.1'));
  $name = defined('DB_NAME') ? DB_NAME : ($DB_NAME ?? ($config['db']['name'] ?? 'iswift'));
    $user = defined('DB_USER') ? DB_USER : ($DB_USER ?? ($config['db']['user'] ?? 'root'));
    $pass = defined('DB_PASS') ? DB_PASS : ($DB_PASS ?? ($config['db']['pass'] ?? ''));
    if (!$pdo && function_exists('db')) {
        $maybe = db();
        if ($maybe instanceof PDO) $pdo = $maybe;
    }
    if (!($pdo instanceof PDO)) {
        try {
            $pdo = new PDO("mysql:host={$host};dbname={$name};charset=utf8mb4", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (Throwable $e) {
            http_response_code(500);
            echo 'DB connection failed.';
            exit;
        }
    }
}

/* Helpers */
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function price_html($price, $sale) {
    $p = (float)$price; $s = $sale !== null ? (float)$sale : null;
    if ($s !== null && $s > 0 && $s < $p) {
        return '<span style="font-weight:700;">₹' . number_format($s) . '</span> <del style="opacity:.6;">₹' . number_format($p) . '</del>';
    }
    return '<span style="font-weight:700;">₹' . number_format($p) . '</span>';
}
function img_url($path) {
    $path = trim((string)$path);
    if ($path !== '') return url('uploads/products/' . ltrim($path, '/'));
    return 'https://via.placeholder.com/900x675.png?text=Product';
}

/* Input */
$slug = trim($_GET['slug'] ?? '');
if ($slug === '') {
    http_response_code(404);
    header('Location: ' . url('products.php'));
    exit;
}

/* Fetch product */
$stmt = $pdo->prepare("SELECT id,name,slug,sku,short_desc,description,price,sale_price,stock,status,brochure_url,meta_title,meta_description,created_at FROM products WHERE slug=:slug AND status='published' LIMIT 1");
$stmt->execute([':slug' => $slug]);
$product = $stmt->fetch();
if (!$product) {
    http_response_code(404);
    header('Location: ' . url('products.php'));
    exit;
}
$id = (int)$product['id'];

/* Related data */
$images = [];
$stmt = $pdo->prepare("SELECT path,is_primary,sort_order,id FROM product_images WHERE product_id=:id ORDER BY is_primary DESC, sort_order ASC, id ASC");
$stmt->execute([':id' => $id]);
$images = $stmt->fetchAll();

$features = [];
$stmt = $pdo->prepare("SELECT feature FROM product_features WHERE product_id=:id ORDER BY sort_order ASC, id ASC");
$stmt->execute([':id' => $id]);
$features = $stmt->fetchAll();

$specs = [];
$stmt = $pdo->prepare("SELECT label,value FROM product_specs WHERE product_id=:id ORDER BY sort_order ASC, id ASC");
$stmt->execute([':id' => $id]);
$specs = $stmt->fetchAll();

$faqs = [];
$stmt = $pdo->prepare("SELECT question,answer FROM product_faqs WHERE product_id=:id ORDER BY sort_order ASC, id ASC");
$stmt->execute([':id' => $id]);
$faqs = $stmt->fetchAll();

/* Meta & header */
$meta_title   = $product['meta_title'] ?: ($product['name'] . ' — iSwift');
$meta_desc    = $product['meta_description'] ?: ($product['short_desc'] ?: 'Product details');
$current_page = 'products';
partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main class="container" style="padding:2rem 0;">
  <div style="display:grid; grid-template-columns: 1.2fr 1fr; gap:2rem; align-items:start;">
    <section>
      <?php $primary = $images[0]['path'] ?? ''; ?>
      <img src="<?= h(img_url($primary)) ?>" alt="<?= h($product['name']) ?>" style="width:100%; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,.08);">
      <?php if (count($images) > 1): ?>
        <div style="display:flex; gap:0.5rem; margin-top:0.75rem; flex-wrap:wrap;">
          <?php foreach ($images as $im): ?>
            <img src="<?= h(img_url($im['path'])) ?>" alt="Thumb" style="width:88px; height:66px; object-fit:cover; border-radius:6px; border:1px solid #eee;">
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

    <aside>
      <h1 style="color:var(--color-accent); margin-bottom:0.25rem;">
        <?= h($product['name']) ?>
      </h1>
      <div style="color:var(--color-muted); font-size:0.9rem;">SKU: <?= h($product['sku']) ?></div>
      <p style="margin:0.75rem 0; color:var(--color-muted);"><?= h($product['short_desc']) ?></p>
      <div style="font-size:1.125rem; margin:0.5rem 0; color:var(--color-accent);">
        <?= price_html($product['price'], $product['sale_price']) ?>
        <?php if ((int)$product['stock'] > 0): ?>
          <span style="margin-left:10px; font-size:0.875rem; color:#0f7a3d; font-weight:600;">In stock</span>
        <?php else: ?>
          <span style="margin-left:10px; font-size:0.875rem; color:#b00020; font-weight:600;">Out of stock</span>
        <?php endif; ?>
      </div>
      <div style="margin-top:1rem; display:flex; gap:0.5rem; flex-wrap:wrap;">
        <?php if (!empty($product['brochure_url'])): ?>
          <a class="btn btn-secondary" href="<?= h($product['brochure_url']) ?>" target="_blank" rel="noopener">Download Brochure</a>
        <?php endif; ?>
        <a class="btn btn-primary" href="<?= url('book-demo.php') ?>">Book a Demo</a>
      </div>
    </aside>
  </div>

  <?php if (!empty($product['description'])): ?>
    <section style="margin-top:2rem; background: var(--color-light); padding:1rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,.06);">
      <?= $product['description'] ?>
    </section>
  <?php endif; ?>

  <?php if ($features): ?>
    <section style="margin-top:2rem;">
      <h2 style="color:var(--color-accent); margin-bottom:0.5rem;">Key Features</h2>
      <ul style="padding-left:1rem; color:var(--color-text);">
        <?php foreach ($features as $f): ?>
          <li style="margin:0.25rem 0;"><?= h($f['feature']) ?></li>
        <?php endforeach; ?>
      </ul>
    </section>
  <?php endif; ?>

  <?php if ($specs): ?>
    <section style="margin-top:2rem;">
      <h2 style="color:var(--color-accent); margin-bottom:0.5rem;">Specifications</h2>
      <div>
        <?php foreach ($specs as $s): ?>
          <div style="display:flex; gap:1rem; padding:0.5rem 0; border-bottom:1px solid #eee;">
            <strong style="min-width:180px;"><?= h($s['label']) ?></strong>
            <span><?= h($s['value']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($faqs): ?>
    <section style="margin-top:2rem;">
      <h2 style="color:var(--color-accent); margin-bottom:0.5rem;">FAQs</h2>
      <div>
        <?php foreach ($faqs as $qa): ?>
          <details style="background: var(--color-light); border:1px solid #eee; border-radius:8px; padding:0.75rem; margin:0.5rem 0;">
            <summary style="cursor:pointer; font-weight:600; color:var(--color-accent);"><?= h($qa['question']) ?></summary>
            <div style="margin-top:0.5rem; color:var(--color-text);"><?= nl2br(h($qa['answer'])) ?></div>
          </details>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>
</main>

<?php partial('footer'); ?>
