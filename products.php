<?php
// Products listing page (uses shared site UI)

require_once __DIR__ . '/core/helpers.php';

/* ====== DB BOOTSTRAP (robust) ====== */
$pdo = $pdo ?? null;

// Try to include admin DB if present
$cfg = __DIR__ . '/admin/includes/config.php';
$dbf = __DIR__ . '/admin/includes/db.php';
if (is_file($cfg)) require_once $cfg;
if (is_file($dbf)) require_once $dbf;

// If still no PDO, try to construct one from common constants/vars
if (!($pdo instanceof PDO)) {
    $host = $name = $user = $pass = null;

    if (defined('DB_HOST')) $host = DB_HOST;
    if (defined('DB_NAME')) $name = DB_NAME;
    if (defined('DB_USER')) $user = DB_USER;
    if (defined('DB_PASS')) $pass = DB_PASS;

    if (!$host && isset($DB_HOST)) $host = $DB_HOST;
    if (!$name && isset($DB_NAME)) $name = $DB_NAME;
    if (!$user && isset($DB_USER)) $user = $DB_USER;
    if (!$pass && isset($DB_PASS)) $pass = $DB_PASS;

    if (isset($config['db'])) {
        $host = $host ?: ($config['db']['host'] ?? null);
        $name = $name ?: ($config['db']['name'] ?? null);
        $user = $user ?: ($config['db']['user'] ?? null);
        $pass = $pass ?: ($config['db']['pass'] ?? null);
    }

    // Fallback dev defaults
    $host = $host ?: '127.0.0.1';
    $name = $name ?: 'iswift_db';
    $user = $user ?: 'root';
    $pass = $pass ?? '';

    if (!$pdo && function_exists('db')) {
        $maybe = db();
        if ($maybe instanceof PDO) $pdo = $maybe;
    }

    if (!$pdo) {
        try {
            $dsn = "mysql:host={$host};dbname={$name};charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $pass, [
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
/* ====== END DB BOOTSTRAP ====== */

/* ====== INPUTS ====== */
$q         = trim($_GET['q'] ?? '');
$min       = trim($_GET['min'] ?? '');
$max       = trim($_GET['max'] ?? '');
$on_sale   = isset($_GET['on_sale']) ? 1 : 0;
$in_stock  = isset($_GET['in_stock']) ? 1 : 0;
$sort      = $_GET['sort'] ?? 'latest'; // latest | price_asc | price_desc | name_asc | name_desc
$per_page  = (int)($_GET['per_page'] ?? 12);
$page      = max(1, (int)($_GET['page'] ?? 1));

$per_page = in_array($per_page, [12, 24, 48], true) ? $per_page : 12;
$offset   = ($page - 1) * $per_page;

/* ====== QUERY BUILDER ====== */
$where  = ["p.status = 'published'"];
$params = [];

if ($q !== '') {
    $where[] = "(p.name LIKE :q OR p.short_desc LIKE :q OR p.sku LIKE :q)";
    $params[':q'] = "%{$q}%";
}
if ($min !== '' && is_numeric($min)) {
    $where[] = "COALESCE(p.sale_price, p.price) >= :minp";
    $params[':minp'] = (float)$min;
}
if ($max !== '' && is_numeric($max)) {
    $where[] = "COALESCE(p.sale_price, p.price) <= :maxp";
    $params[':maxp'] = (float)$max;
}
if ($on_sale) {
    $where[] = "p.sale_price IS NOT NULL";
}
if ($in_stock) {
    $where[] = "p.stock > 0";
}

// Sort: use created_at (updated_at may not exist)
$order = "p.created_at DESC";
switch ($sort) {
    case 'price_asc':
        $order = "COALESCE(p.sale_price, p.price) ASC";
        break;
    case 'price_desc':
        $order = "COALESCE(p.sale_price, p.price) DESC";
        break;
    case 'name_asc':
        $order = "p.name ASC";
        break;
    case 'name_desc':
        $order = "p.name DESC";
        break;
    case 'latest':
    default:
        $order = "p.created_at DESC";
}

$wsql = $where ? ("WHERE " . implode(' AND ', $where)) : '';

/* ====== DATA ====== */
$total = 0; $pages = 1; $rows = [];
if ($pdo instanceof PDO) {
    // Count
    $countSql = "SELECT COUNT(*) AS cnt FROM products p $wsql";
    $stmt = $pdo->prepare($countSql);
    $stmt->execute($params);
    $total = (int)$stmt->fetchColumn();
    $pages = max(1, (int)ceil($total / $per_page));

    // Data with primary image, fallback to first image
    $sql = "
    SELECT
      p.id, p.name, p.slug, p.sku, p.short_desc, p.price, p.sale_price, p.stock,
      COALESCE(pim.path, pia.path) AS image_path
    FROM products p
    LEFT JOIN (
      SELECT product_id, path
      FROM product_images
      WHERE is_primary = 1
      GROUP BY product_id
    ) pim ON pim.product_id = p.id
    LEFT JOIN (
      SELECT pi2.product_id, pi2.path
      FROM product_images pi2
      INNER JOIN (
        SELECT product_id, MIN(id) AS min_id
        FROM product_images
        GROUP BY product_id
      ) x ON x.product_id = pi2.product_id AND x.min_id = pi2.id
    ) pia ON pia.product_id = p.id
    $wsql
    ORDER BY $order
    LIMIT :lim OFFSET :off";

    $stmt = $pdo->prepare($sql);
    foreach ($params as $k => $v) $stmt->bindValue($k, $v);
    $stmt->bindValue(':lim', $per_page, PDO::PARAM_INT);
    $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();
}

/* ====== HELPERS ====== */
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function price_html($price, $sale) {
    if ($sale !== null && $sale !== '' && (float)$sale > 0 && (float)$sale < (float)$price) {
        return '<span style="font-weight:600;">₹' . number_format((float)$sale) . '</span> <del style="opacity:.6;">₹' . number_format((float)$price) . '</del>';
    }
    return '₹' . number_format((float)$price);
}
function img_url($path) {
    $path = trim((string)$path);
    if ($path !== '') {
        return url('uploads/products/' . ltrim($path, '/'));
    }
    return 'https://via.placeholder.com/600x400.png?text=Product';
}
function qp($overrides = []) {
    $qs = array_merge($_GET, $overrides);
    return '?' . http_build_query($qs);
}

/* ====== META & HEADER ====== */
$meta_title = 'Products — iSwift';
$meta_desc  = 'Browse smart home devices including locks, doorbells, mesh Wi‑Fi and more.';
$current_page = 'products';
partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main class="container" style="padding: 2rem 0;">
    <h1 style="margin-bottom:0.25rem; color: var(--color-accent);">Products</h1>
    <p style="color: var(--color-muted); margin-bottom: 1rem;">Explore our range of smart home devices and components.</p>

    <div class="toolbar" style="display:flex; justify-content:space-between; align-items:center; gap:1rem; flex-wrap:wrap;">
      <div style="color: var(--color-muted);">
        <?= $total ?> result<?= $total === 1 ? '' : 's' ?> found
      </div>
      <div>
        <span style="font-size:0.875rem; color: var(--color-muted);">Sort:</span>
        <a class="btn" href="<?= h(qp(['sort' => 'latest', 'page' => 1])) ?>" style="margin-left:0.5rem;">Latest</a>
        <a class="btn" href="<?= h(qp(['sort' => 'price_asc', 'page' => 1])) ?>">Price Low→High</a>
        <a class="btn" href="<?= h(qp(['sort' => 'price_desc', 'page' => 1])) ?>">Price High→Low</a>
        <a class="btn" href="<?= h(qp(['sort' => 'name_asc', 'page' => 1])) ?>">Name A–Z</a>
        <a class="btn" href="<?= h(qp(['sort' => 'name_desc', 'page' => 1])) ?>">Name Z–A</a>
      </div>
    </div>

    <!-- Filters -->
    <form method="get" action="" style="margin-top:1rem; background: var(--color-light); padding:1rem; border:1px solid #eaeaea; border-radius:8px; display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap:0.75rem; align-items:end;">
      <div>
        <label for="q" style="display:block; font-size:0.875rem; color:var(--color-muted);">Search</label>
        <input type="text" id="q" name="q" value="<?= h($q) ?>" placeholder="Name, SKU, description" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
      </div>
      <div>
        <label for="min" style="display:block; font-size:0.875rem; color:var(--color-muted);">Min Price (₹)</label>
        <input type="number" id="min" name="min" min="0" step="100" value="<?= h($min) ?>" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
      </div>
      <div>
        <label for="max" style="display:block; font-size:0.875rem; color:var(--color-muted);">Max Price (₹)</label>
        <input type="number" id="max" name="max" min="0" step="100" value="<?= h($max) ?>" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
      </div>
      <div>
        <label for="sort" style="display:block; font-size:0.875rem; color:var(--color-muted);">Sort by</label>
        <select id="sort" name="sort" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
          <option value="latest" <?= $sort === 'latest' ? 'selected' : '' ?>>Latest</option>
          <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Price: Low to High</option>
          <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Price: High to Low</option>
          <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : '' ?>>Name: A–Z</option>
          <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : '' ?>>Name: Z–A</option>
        </select>
      </div>
      <div>
        <label for="per_page" style="display:block; font-size:0.875rem; color:var(--color-muted);">Per page</label>
        <select id="per_page" name="per_page" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
          <?php foreach ([12, 24, 48] as $n): ?>
            <option value="<?= $n ?>" <?= $per_page === $n ? 'selected' : '' ?>><?= $n ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div style="display:flex; gap:12px; align-items:center;">
        <div>
          <input type="checkbox" id="on_sale" name="on_sale" <?= $on_sale ? 'checked' : '' ?>>
          <label for="on_sale" style="font-size:0.875rem; color:var(--color-muted);">On Sale</label>
        </div>
        <div>
          <input type="checkbox" id="in_stock" name="in_stock" <?= $in_stock ? 'checked' : '' ?>>
          <label for="in_stock" style="font-size:0.875rem; color:var(--color-muted);">In Stock</label>
        </div>
      </div>
      <div>
        <button class="btn btn-primary" type="submit">Apply</button>
        <a class="btn btn-secondary" href="<?= url('products.php') ?>" style="margin-left:8px;">Reset</a>
      </div>
    </form>

    <!-- Products grid -->
    <section style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:1.5rem; margin-top:1.5rem;">
      <?php if (!$rows): ?>
        <p style="color: var(--color-muted);">No products match your filters.</p>
      <?php else: ?>
        <?php foreach ($rows as $r): ?>
          <article style="background: var(--color-light); border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1rem;">
            <a href="<?= url('product-details.php?slug=' . urlencode($r['slug'])) ?>">
              <img src="<?= h(img_url($r['image_path'])) ?>" alt="<?= h($r['name']) ?>" loading="lazy" style="width:100%; border-radius:6px; margin-bottom:0.75rem;">
              <h3 style="font-size:1.125rem; font-weight:600; color: var(--color-accent);"><?= h($r['name']) ?></h3>
            </a>
            <div style="font-size:0.875rem; color: var(--color-muted);">SKU: <?= h($r['sku']) ?></div>
            <p style="margin-top:8px; color: var(--color-muted);"><?= h($r['short_desc']) ?></p>
            <div style="color: var(--color-accent); font-weight:600;"><?= price_html($r['price'], $r['sale_price']); ?></div>
            <div style="margin-top:6px;">
              <?= ($r['stock'] > 0) ? '<span style="font-size:0.875rem; color:#0f7a3d; font-weight:600;">In stock</span>' : '<span style="font-size:0.875rem; color:#b00020; font-weight:600;">Out of stock</span>'; ?>
            </div>
            <div style="margin-top:12px;">
              <a class="btn btn-secondary" href="<?= url('product-details.php?slug=' . urlencode($r['slug'])) ?>">View Details</a>
            </div>
          </article>
        <?php endforeach; ?>
      <?php endif; ?>
    </section>

    <!-- Pagination -->
    <?php if ($pages > 1): ?>
      <nav aria-label="Pagination" style="margin-top:1.5rem;">
        <?php
        $start = max(1, $page - 2);
        $end   = min($pages, $page + 2);
        if ($page > 1) {
          echo '<a class="btn" href="' . h(qp(['page' => 1])) . '">First</a>';
          echo ' <a class="btn" href="' . h(qp(['page' => $page - 1])) . '">Prev</a>';
        }
        for ($p = $start; $p <= $end; $p++) {
          if ($p == $page) {
            echo ' <span class="btn btn-secondary">' . $p . '</span>';
          } else {
            echo ' <a class="btn" href="' . h(qp(['page' => $p])) . '">' . $p . '</a>';
          }
        }
        if ($page < $pages) {
          echo ' <a class="btn" href="' . h(qp(['page' => $page + 1])) . '">Next</a>';
          echo ' <a class="btn" href="' . h(qp(['page' => $pages])) . '">Last</a>';
        }
        ?>
      </nav>
    <?php endif; ?>
</main>

<?php partial('footer'); ?>

