<?php
// Landing page for installation & service areas

require_once __DIR__ . '/core/helpers.php';

$meta_title = 'Installation & Service Areas – iSwift';
$meta_desc  = 'iSwift provides smart home installation and support across Delhi NCR including Delhi, Noida, Gurugram, Ghaziabad, Faridabad and Greater Noida.';
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));

// List of service areas
$areas = [
    'delhi'         => 'Delhi',
    'noida'         => 'Noida',
    'gurugram'      => 'Gurugram',
    'ghaziabad'     => 'Ghaziabad',
    'faridabad'     => 'Faridabad',
    'greater-noida' => 'Greater Noida',
];
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">Where We Operate</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">iSwift offers installation and after‑sales support across the Delhi NCR region. Select your city to learn more about our services there.</p>
        <div style="display:flex; flex-wrap:wrap; gap:2rem; justify-content:center;">
            <?php foreach ($areas as $slug => $name): ?>
                <article style="flex:1 1 240px; background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08); text-align:center;">
                    <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">
                        <?= esc($name) ?>
                    </h3>
                    <p style="color:var(--color-muted); margin-bottom:1rem; font-size:0.875rem;">Smart home installation & support in <?= esc($name) ?></p>
                    <a class="btn btn-primary" href="<?= url('service-area.php?slug=' . $slug) ?>">View Details</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php partial('footer');
