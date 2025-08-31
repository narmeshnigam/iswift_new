<?php
// Individual project detail page

require_once __DIR__ . '/../core/helpers.php';

// Determine slug
$slug = $_GET['slug'] ?? '';

// Define a static set of project details.  In a real system these would come
// from a database via the admin CMS.  Each project includes a title,
// location, description, key solutions used and outcome metrics.
$projects = [
    'luxury-apartment-vaishali' => [
        'title' => 'Luxury Apartment in Vaishali',
        'location' => 'Ghaziabad',
        'description' => 'This 3 BHK apartment was fully automated with smart lighting, motorized curtains, climate control and an integrated security system. The client wanted a seamless solution that blended with the décor while offering complete control via mobile and voice.',
        'solutions' => ['Smart Lighting', 'Smart Curtains & Blinds', 'Climate Control', 'Security & Sensors'],
        'outcome' => 'Homeowners enjoy 35% energy savings, improved security and the convenience of remote control from anywhere.',
    ],
    'villa-gurugram' => [
        'title' => 'Modern Villa in Gurugram',
        'location' => 'Gurugram',
        'description' => 'We transformed this villa with video doorbells, mesh Wi‑Fi networking and multi‑room audio. Outdoor cameras and smart locks provide added security while the entertainment system delivers an immersive cinematic experience.',
        'solutions' => ['Video Doorbells', 'Wi‑Fi & Networking', 'Home Entertainment', 'Smart Locks'],
        'outcome' => 'Residents now enjoy uninterrupted connectivity, advanced security and a fully integrated entertainment setup.',
    ],
    'smart-office-noida' => [
        'title' => 'Smart Office in Noida',
        'location' => 'Noida',
        'description' => 'A retrofitted office space featuring retrofit switches, energy monitoring and automated conference rooms. Scheduling and occupancy sensors reduce energy waste while employees enjoy hands‑free control via voice commands.',
        'solutions' => ['Retrofit Switches', 'Energy Monitoring', 'Voice Assistants'],
        'outcome' => 'The company reported a 20% reduction in electricity bills and improved employee productivity through automation.',
    ],
];

// If slug invalid -> 404
if (!isset($projects[$slug])) {
    http_response_code(404);
    $meta_title = 'Project Not Found – iSwift';
    $meta_desc  = '';
    $current_page = '';
    partial('header', compact('meta_title', 'meta_desc', 'current_page'));
    echo '<main><section class="container" style="padding:3rem 0"><h1>Project Not Found</h1><p>Sorry, the project you requested does not exist.</p></section></main>';
    partial('footer');
    exit;
}

$project = $projects[$slug];

$meta_title = $project['title'] . ' – iSwift Project';
$meta_desc  = 'Case study of ' . $project['title'] . ' using iSwift smart home solutions.';
$current_page = 'projects';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="color:var(--color-accent);"><?= esc($project['title']) ?></h1>
        <p style="color:var(--color-muted); font-size:1rem;">Location: <?= esc($project['location']) ?></p>
        <p style="max-width:720px; margin:1rem 0; color:var(--color-muted);">
            <?= esc($project['description']) ?>
        </p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Solutions Used</h2>
        <ul style="list-style:none; padding:0; margin-bottom:1rem;">
            <?php foreach ($project['solutions'] as $solution): ?>
                <li style="padding:0.25rem 0; display:flex; align-items:flex-start;">
                    <span style="color:var(--color-accent); margin-right:0.5rem; font-weight:bold;">•</span>
                    <span style="color:var(--color-muted);">
                        <?= esc($solution) ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
        <h2 style="color:var(--color-accent); margin-top:1.5rem;">Results</h2>
        <p style="max-width:720px; color:var(--color-muted);">
            <?= esc($project['outcome']) ?>
        </p>
        <div style="margin-top:2rem;">
            <a class="btn btn-primary" href="<?= url('book-demo.php') ?>">Book a Demo</a>
            <a class="btn btn-secondary" href="<?= url('projects.php') ?>">Back to Projects</a>
        </div>
    </section>
</main>

<?php partial('footer');