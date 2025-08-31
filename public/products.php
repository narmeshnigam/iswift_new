<?php
// Products listing page

require_once __DIR__ . '/../core/helpers.php';
require_once __DIR__ . '/../core/db.php';

// Capture query parameters
$q        = trim($_GET['q'] ?? '');
$min      = trim($_GET['min'] ?? '');
$max      = trim($_GET['max'] ?? '');
$in_stock = isset($_GET['in_stock']) ? 1 : 0;
$sort     = $_GET['sort'] ?? 'latest';
$per_page = (int)($_GET['per_page'] ?? 12);
$page     = max(1, (int)($_GET['page'] ?? 1));

// Validate per-page
$per_page = in_array($per_page, [12, 24, 48], true) ? $per_page : 12;
$offset   = ($page - 1) * $per_page;

// Build where clause
$where  = ["p.status = 'published'"]; 
$params = [];
if ($q !== '') {
    $where[] = "(p.name LIKE :q OR p.short_desc LIKE :q OR p.sku LIKE :q)";
    $params[':q'] = '%' . $q . '%';
}
if ($min !== '' && is_numeric($min)) {
    $where[] = 'COALESCE(p.sale_price, p.price) >= :minp';
    $params[':minp'] = (float)$min;
}
if ($max !== '' && is_numeric($max)) {
    $where[] = 'COALESCE(p.sale_price, p.price) <= :maxp';
    $params[':maxp'] = (float)$max;
}
if ($in_stock) {
    $where[] = 'p.stock > 0';
}

// Sorting
$order = 'p.updated_at DESC';
switch ($sort) {
    case 'price_asc':
        $order = 'COALESCE(p.sale_price, p.price) ASC';
        break;
    case 'price_desc':
        $order = 'COALESCE(p.sale_price, p.price) DESC';
        break;
    case 'name_asc':
        $order = 'p.name ASC';
        break;
    case 'name_desc':
        $order = 'p.name DESC';
        break;
    case 'latest':
    default:
        $order = 'p.updated_at DESC';
}

// Build SQL
$where_sql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';
$pdo = db();

// Count total
$count_stmt = $pdo->prepare("SELECT COUNT(*) FROM products p $where_sql");
foreach ($params as $k => $v) {
    $count_stmt->bindValue($k, $v);
}
$count_stmt->execute();
$total = (int)$count_stmt->fetchColumn();
$pages = max(1, (int)ceil($total / $per_page));

// Fetch products with primary image
$sql = "
SELECT
  p.id, p.name, p.slug, p.sku, p.short_desc, p.price, p.sale_price, p.stock, p.updated_at,
  COALESCE(pi.path, '') AS image_path
FROM products p
LEFT JOIN (
  SELECT product_id, path
  FROM product_images
  WHERE is_primary = 1
  GROUP BY product_id
) pi ON pi.product_id = p.id
$where_sql
ORDER BY $order
LIMIT :lim OFFSET :off
";

$stmt = $pdo->prepare($sql);
foreach ($params as $k => $v) {
    $stmt->bindValue($k, $v);
}
$stmt->bindValue(':lim', $per_page, PDO::PARAM_INT);
$stmt->bindValue(':off', $offset, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll();

// Helpers
function price_html($price, $sale): string
{
    if ($sale !== null && $sale !== '' && (float)$sale > 0 && (float)$sale < (float)$price) {
        return '<span style="font-weight:600;">₹' . number_format((float)$sale) . '</span> <del style="opacity:.6;">₹' . number_format((float)$price) . '</del>';
    }
    return '₹' . number_format((float)$price);
}

function img_url($path): string
{
    $path = trim((string)$path);
    if ($path !== '') {
        return url('uploads/products/' . ltrim($path, '/'));
    }
    // fallback placeholder
    return 'https://via.placeholder.com/600x400.png?text=Product';
}

// Meta
$meta_title = 'Products – iSwift';
$meta_desc  = 'Browse our curated collection of smart home products including locks, sensors, mesh systems and more.';
$current_page = 'products';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main class="container" style="padding: 2rem 0;">
    <h1 style="margin-bottom:1rem; color: var(--color-accent);">Products</h1>
    <p style="color: var(--color-muted); margin-bottom: 2rem;">Explore our range of smart home devices and components.</p>

    <!-- Filters -->
    <form method="get" style="margin-bottom:2rem; display:flex; flex-wrap:wrap; gap:1rem; align-items:flex-end;">
        <div>
            <label for="q" style="display:block; font-size:0.875rem; color:var(--color-muted);">Search</label>
            <input type="text" id="q" name="q" value="<?= esc($q) ?>" style="padding:0.5rem; border:1px solid #ccc; border-radius:4px; width:200px;">
        </div>
        <div>
            <label for="min" style="display:block; font-size:0.875rem; color:var(--color-muted);">Min price</label>
            <input type="number" id="min" name="min" value="<?= esc($min) ?>" style="padding:0.5rem; border:1px solid #ccc; border-radius:4px; width:120px;">
        </div>
        <div>
            <label for="max" style="display:block; font-size:0.875rem; color:var(--color-muted);">Max price</label>
            <input type="number" id="max" name="max" value="<?= esc($max) ?>" style="padding:0.5rem; border:1px solid #ccc; border-radius:4px; width:120px;">
        </div>
        <div style="display:flex; align-items:center; gap:0.5rem; margin-top:1.5rem;">
            <input type="checkbox" id="in_stock" name="in_stock" value="1" <?= $in_stock ? 'checked' : '' ?>>
            <label for="in_stock" style="font-size:0.875rem; color:var(--color-muted);">In stock</label>
        </div>
        <div>
            <label for="sort" style="display:block; font-size:0.875rem; color:var(--color-muted);">Sort by</label>
            <select id="sort" name="sort" style="padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
                <option value="latest" <?= $sort === 'latest' ? 'selected' : '' ?>>Latest</option>
                <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Price: Low to High</option>
                <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Price: High to Low</option>
                <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : '' ?>>Name: A–Z</option>
                <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : '' ?>>Name: Z–A</option>
            </select>
        </div>
        <div>
            <label for="per_page" style="display:block; font-size:0.875rem; color:var(--color-muted);">Per page</label>
            <select id="per_page" name="per_page" style="padding:0.5rem; border:1px solid #ccc; border-radius:4px;">
                <?php foreach ([12, 24, 48] as $n): ?>
                    <option value="<?= $n ?>" <?= $per_page === $n ? 'selected' : '' ?>><?= $n ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>
    </form>

    <!-- Products grid -->
    <div style="display:grid; gap:1.5rem; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));">
        <?php if (!$rows): ?>
            <p style="grid-column:1/-1; color:var(--color-muted);">No products found.</p>
        <?php else: ?>
            <?php foreach ($rows as $r): ?>
                <article style="background: var(--color-light); border-radius:8px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
                    <a href="<?= url('product-details.php?slug=' . urlencode($r['slug'])) ?>">
                        <img src="<?= esc(img_url($r['image_path'])) ?>" alt="<?= esc($r['name']) ?>" style="width:100%; height:160px; object-fit:cover;">
                    </a>
                    <div style="padding:1rem;">
                        <h3 style="font-size:1.125rem; color:var(--color-accent); margin-bottom:0.25rem;">
                            <a href="<?= url('product-details.php?slug=' . urlencode($r['slug'])) ?>" style="color:inherit; text-decoration:none;"><?= esc($r['name']) ?></a>
                        </h3>
                        <p style="font-size:0.875rem; color:var(--color-muted);">SKU: <?= esc($r['sku']) ?></p>
                        <p style="margin:0.5rem 0; font-weight:600; color:var(--color-accent);"><?= price_html($r['price'], $r['sale_price']) ?></p>
                        <?php if ($r['stock'] > 0): ?>
                            <p style="font-size:0.75rem; color:#0f7a3d; font-weight:600;">In Stock</p>
                        <?php else: ?>
                            <p style="font-size:0.75rem; color:#b00020; font-weight:600;">Out of Stock</p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($pages > 1): ?>
        <nav aria-label="Pagination" style="margin-top:2rem;">
            <ul style="display:flex; gap:0.5rem; justify-content:center; list-style:none; padding:0;">
                <?php for ($i = 1; $i <= $pages; $i++): ?>
                    <?php $qs = array_merge($_GET, ['page' => $i]); ?>
                    <li>
                        <a href="<?= url('products.php') . '?' . http_build_query($qs) ?>" class="btn <?= $i == $page ? 'btn-secondary' : 'btn' ?>" style="min-width:2rem; text-align:center;"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</main>

<?php
partial('footer');