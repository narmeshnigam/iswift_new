<?php
// Product category listing page

require_once __DIR__ . '/../core/helpers.php';

$slug = $_GET['slug'] ?? '';

// Define sample categories and associated products for demonstration.  In a real
// system these would come from the database via CMS.
$categories = [
    'locks' => [
        'name' => 'Smart Locks',
        'description' => 'Keyless smart locks for doors and gates. Enjoy secure, convenient access control.',
        'products' => ['Smart Lock L1', 'Smart Lock L2', 'Smart Lock Pro'],
    ],
    'doorbells' => [
        'name' => 'Video Doorbells',
        'description' => 'See and speak to visitors at your doorstep via HD video doorbells.',
        'products' => ['Doorbell Plus', 'Doorbell 2K', 'Doorbell Pro'],
    ],
    'mesh-wifi' => [
        'name' => 'Mesh Wi‑Fi Systems',
        'description' => 'High‑performance mesh networking for seamless connectivity across your home.',
        'products' => ['Mesh 3‑Pack', 'Mesh AX System', 'Mesh Pro 6E'],
    ],
];

// If slug invalid, show 404
if (!isset($categories[$slug])) {
    http_response_code(404);
    $meta_title = 'Category Not Found – iSwift';
    $meta_desc  = '';
    $current_page = '';
    partial('header', compact('meta_title', 'meta_desc', 'current_page'));
    echo '<main><section class="container" style="padding:3rem 0"><h1>Category Not Found</h1><p>Sorry, that category does not exist.</p></section></main>';
    partial('footer');
    exit;
}

$cat = $categories[$slug];

$meta_title = $cat['name'] . ' – iSwift Products';
$meta_desc  = $cat['description'];
$current_page = 'products';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="color:var(--color-accent);">
            <?= esc($cat['name']) ?>
        </h1>
        <p style="max-width:720px; margin-bottom:1.5rem; color:var(--color-muted);">
            <?= esc($cat['description']) ?>
        </p>
        <div style="display:flex; flex-wrap:wrap; gap:2rem;">
            <?php foreach ($cat['products'] as $productName): ?>
                <article style="flex:1 1 240px; background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                    <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">
                        <?= esc($productName) ?>
                    </h3>
                    <p style="color:var(--color-muted); margin-bottom:1rem; font-size:0.875rem;">Brief description of <?= esc($productName) ?>.</p>
                    <a class="btn btn-primary" href="<?= url('product-details.php?slug=' . strtolower(str_replace(' ', '-', $productName))) ?>">View Product</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php partial('footer');