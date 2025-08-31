<?php
// Product detail page

require_once __DIR__ . '/../core/helpers.php';
require_once __DIR__ . '/../core/db.php';

// Get slug from query
$slug = trim($_GET['slug'] ?? '');
if ($slug === '') {
    http_response_code(400);
    $meta_title = 'Product Not Found – iSwift';
    $meta_desc  = 'The requested product could not be found.';
    $current_page = 'products';
    partial('header', compact('meta_title', 'meta_desc', 'current_page'));
    echo '<main class="container" style="padding:4rem 0;"><h1>Product not found</h1><p>The requested item could not be found. Please return to the <a href="' . esc(url('products.php')) . '">products page</a>.</p></main>';
    partial('footer');
    exit;
}

$pdo = db();

// Fetch product
$stmt = $pdo->prepare("SELECT id, name, sku, short_desc, description, price, sale_price, stock, status, meta_title, meta_description FROM products WHERE slug = :slug AND status = 'published' LIMIT 1");
$stmt->execute([':slug' => $slug]);
$product = $stmt->fetch();

if (!$product) {
    http_response_code(404);
    $meta_title = 'Product Not Found – iSwift';
    $meta_desc  = 'The requested product could not be found.';
    $current_page = 'products';
    partial('header', compact('meta_title', 'meta_desc', 'current_page'));
    echo '<main class="container" style="padding:4rem 0;"><h1>Product not found</h1><p>The requested item could not be found. Please return to the <a href="' . esc(url('products.php')) . '">products page</a>.</p></main>';
    partial('footer');
    exit;
}

$product_id = (int)$product['id'];

// Images
$img_stmt = $pdo->prepare("SELECT path, is_primary FROM product_images WHERE product_id = :id ORDER BY is_primary DESC, id ASC");
$img_stmt->execute([':id' => $product_id]);
$images = $img_stmt->fetchAll();

// Specifications
$spec_stmt = $pdo->prepare("SELECT label, value FROM product_specs WHERE product_id = :id ORDER BY sort_order ASC, id ASC");
$spec_stmt->execute([':id' => $product_id]);
$specs = $spec_stmt->fetchAll();

// Features
$feat_stmt = $pdo->prepare("SELECT feature FROM product_features WHERE product_id = :id ORDER BY sort_order ASC, id ASC");
$feat_stmt->execute([':id' => $product_id]);
$features = $feat_stmt->fetchAll();

// FAQs
$faq_stmt = $pdo->prepare("SELECT question, answer FROM product_faqs WHERE product_id = :id ORDER BY sort_order ASC, id ASC");
$faq_stmt->execute([':id' => $product_id]);
$faqs = $faq_stmt->fetchAll();

// Meta tags
$meta_title = $product['meta_title'] ?: ($product['name'] . ' – iSwift');
$meta_desc  = $product['meta_description'] ?: ($product['short_desc'] ?: 'Smart home product by iSwift');
$current_page = 'products';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main class="container" style="padding: 2rem 0;">
    <nav aria-label="Breadcrumb" style="margin-bottom:1rem; font-size:0.875rem;">
        <a href="<?= url('') ?>">Home</a> &raquo; <a href="<?= url('products.php') ?>">Products</a> &raquo; <?= esc($product['name']) ?>
    </nav>
    <div style="display:flex; flex-wrap:wrap; gap:2rem;">
        <!-- Image gallery -->
        <div style="flex:1 1 350px; max-width:500px;">
            <?php
            if ($images) {
                $primary = $images[0]['path'];
                $img_src = $primary ? url('uploads/products/' . ltrim($primary, '/')) : 'https://via.placeholder.com/600x400.png?text=Product';
                echo '<img src="' . esc($img_src) . '" alt="' . esc($product['name']) . '" style="width:100%; height:auto; border-radius:8px; object-fit:cover;">';
                // Thumbnails
                if (count($images) > 1) {
                    echo '<div style="display:flex; gap:0.5rem; margin-top:0.5rem;">';
                    foreach ($images as $img) {
                        $thumb = url('uploads/products/' . ltrim($img['path'], '/'));
                        // Escape quotes correctly inside the onclick handler
                        echo '<img src="' . esc($thumb) . '" alt="" style="width:60px; height:60px; object-fit:cover; border-radius:4px; cursor:pointer;" onclick="this.parentNode.parentNode.querySelector(\'img:first-child\').src=this.src;">';
                    }
                    echo '</div>';
                }
            } else {
                echo '<img src="https://via.placeholder.com/600x400.png?text=Product" alt="' . esc($product['name']) . '" style="width:100%; height:auto; border-radius:8px; object-fit:cover;">';
            }
            ?>
        </div>
        <!-- Product details -->
        <div style="flex:1 1 300px;">
            <h1 style="color:var(--color-accent); margin-bottom:0.5rem;"><?= esc($product['name']) ?></h1>
            <p style="font-size:0.875rem; color:var(--color-muted); margin-bottom:0.25rem;">SKU: <?= esc($product['sku']) ?></p>
            <p style="font-size:1.25rem; font-weight:600; color:var(--color-accent); margin-bottom:0.5rem;">
                <?php
                $p = (float)$product['price'];
                $s = $product['sale_price'] !== null ? (float)$product['sale_price'] : null;
                if ($s !== null && $s > 0 && $s < $p) {
                    echo '<span>₹' . number_format($s) . '</span> <del style="opacity:.6;">₹' . number_format($p) . '</del>';
                } else {
                    echo '₹' . number_format($p);
                }
                ?>
            </p>
            <p style="font-size:0.875rem; color:<?= $product['stock'] > 0 ? '#0f7a3d' : '#b00020' ?>; font-weight:600; margin-bottom:0.5rem;">
                <?= $product['stock'] > 0 ? 'In Stock' : 'Out of Stock' ?>
            </p>
            <?php if ($product['short_desc']): ?>
                <p style="margin-bottom:1rem; color:var(--color-text); line-height:1.6;">
                    <?= nl2br(esc($product['short_desc'])) ?>
                </p>
            <?php endif; ?>
            <div style="margin-bottom:1.5rem;">
                <a href="<?= url('book-demo.php') ?>" class="btn btn-primary">Book a Demo</a>
            </div>
        </div>
    </div>
    <!-- Long description -->
    <?php if (!empty($product['description'])): ?>
        <section style="margin-top:3rem;">
            <h2 style="color:var(--color-accent); margin-bottom:1rem;">Description</h2>
            <div style="color:var(--color-text); line-height:1.6;">
                <?= $product['description'] ?>
            </div>
        </section>
    <?php endif; ?>
    <!-- Features -->
    <?php if ($features): ?>
        <section style="margin-top:2rem;">
            <h2 style="color:var(--color-accent); margin-bottom:1rem;">Key Features</h2>
            <ul style="list-style:disc; margin-left:1.5rem; color:var(--color-text);">
                <?php foreach ($features as $f): ?>
                    <li style="margin-bottom:0.5rem;"><?= esc($f['feature']) ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>
    <!-- Specifications -->
    <?php if ($specs): ?>
        <section style="margin-top:2rem;">
            <h2 style="color:var(--color-accent); margin-bottom:1rem;">Specifications</h2>
            <table style="width:100%; border-collapse: collapse;">
                <?php foreach ($specs as $s): ?>
                    <tr>
                        <th style="text-align:left; padding:0.5rem; background:var(--color-secondary); width:30%; color:var(--color-accent); font-weight:600;"><?= esc($s['label']) ?></th>
                        <td style="padding:0.5rem; border-bottom:1px solid #eaeaea;"><?= esc($s['value']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
    <?php endif; ?>
    <!-- FAQs -->
    <?php if ($faqs): ?>
        <section style="margin-top:2rem;">
            <h2 style="color:var(--color-accent); margin-bottom:1rem;">Frequently Asked Questions</h2>
            <div>
                <?php foreach ($faqs as $faq): ?>
                    <div style="margin-bottom:1rem;">
                        <strong style="display:block; margin-bottom:0.25rem;">Q: <?= esc($faq['question']) ?></strong>
                        <p style="margin-left:1rem;">A: <?= esc($faq['answer']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
partial('footer');
