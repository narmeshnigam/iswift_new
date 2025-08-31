<?php
// Projects listing page

require_once __DIR__ . '/core/helpers.php';

$meta_title = 'Projects – iSwift';
$meta_desc  = 'Browse selected smart home projects completed by the iSwift team across Delhi NCR. See how we bring automation to apartments, villas and offices.';
$current_page = 'projects';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));

// Define a simple list of sample projects for illustration.
$projects = [
    'luxury-apartment-vaishali' => [
        'title' => 'Luxury Apartment in Vaishali',
        'location' => 'Ghaziabad',
        'snippet' => 'Full home automation including lights, curtains, climate control and security sensors in a 3 BHK apartment.',
    ],
    'villa-gurugram' => [
        'title' => 'Modern Villa in Gurugram',
        'location' => 'Gurugram',
        'snippet' => 'A premium villa equipped with video doorbells, mesh Wi‑Fi and multi‑room audio.',
    ],
    'smart-office-noida' => [
        'title' => 'Smart Office in Noida',
        'location' => 'Noida',
        'snippet' => 'Retrofit switches, energy monitoring and automated conference rooms for improved productivity.',
    ],
];
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">Our Projects</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">Get inspired by our latest installations. These case studies highlight the versatility and effectiveness of iSwift smart home solutions.</p>
        <div style="display:flex; flex-wrap:wrap; gap:2rem; justify-content:center;">
            <?php foreach ($projects as $slug => $project): ?>
                <article style="flex:1 1 280px; background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                    <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">
                        <?= esc($project['title']) ?>
                    </h3>
                    <p style="color:var(--color-muted); font-size:0.875rem; margin-bottom:0.25rem;">Location: <?= esc($project['location']) ?></p>
                    <p style="color:var(--color-muted); margin-bottom:1rem;">
                        <?= esc($project['snippet']) ?>
                    </p>
                    <a class="btn btn-primary" href="<?= url('project.php?slug=' . $slug) ?>">Read More</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php partial('footer');
