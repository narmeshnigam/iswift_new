<?php
// Learn hub (blog/knowledge base) page

require_once __DIR__ . '/../core/helpers.php';

$meta_title = 'Learn – Smart Home Guides & Insights | iSwift';
$meta_desc  = 'Explore articles, guides and tutorials on smart home automation, product comparisons, installation tips and more. Stay informed with iSwift’s knowledge hub.';
$current_page = 'learn';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));

// Sample categories and posts (normally this would come from a database)
$categories = [
    'buying-guides' => 'Buying Guides',
    'how-tos'       => 'How-Tos',
    'troubleshooting' => 'Troubleshooting',
    'news'          => 'News & Updates',
];

$posts = [
    [
        'title' => 'How to Choose the Right Smart Lock for Your Apartment',
        'category' => 'buying-guides',
        'excerpt' => 'A practical guide to picking a reliable smart lock in India, covering compatibility, connectivity, installation and price factors.',
    ],
    [
        'title' => 'Troubleshooting Mesh Wi‑Fi: 5 Common Issues Solved',
        'category' => 'troubleshooting',
        'excerpt' => 'Got slow speeds or dead zones? Here are quick fixes for optimizing your mesh network performance.',
    ],
    [
        'title' => 'Retrofit vs. Replacement: Which Smart Switch Solution Is Right?',
        'category' => 'buying-guides',
        'excerpt' => 'We compare retrofit modules with full replacement smart switches to help you decide the best upgrade path.',
    ],
    [
        'title' => 'Set Up Voice Routines with Alexa and Google Assistant',
        'category' => 'how-tos',
        'excerpt' => 'Learn to configure custom voice routines that trigger multiple smart devices with a single command.',
    ],
];
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">Learn</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">
            Discover our curated articles and tutorials to help you navigate the world of smart home automation. Browse by category or explore featured posts.
        </p>
        <!-- Category filter (not functional but shows categories) -->
        <div style="display:flex; flex-wrap:wrap; gap:1rem; justify-content:center; margin-bottom:2rem;">
            <?php foreach ($categories as $slug => $name): ?>
                <a href="#" class="btn btn-secondary" style="font-size:0.875rem;"><?= esc($name) ?></a>
            <?php endforeach; ?>
        </div>
        <!-- Posts grid -->
        <div style="display:flex; flex-wrap:wrap; gap:2rem; justify-content:center;">
            <?php foreach ($posts as $post): ?>
                <article style="flex:1 1 300px; background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                    <h3 style="color:var(--color-accent); margin-bottom:0.5rem;"><?= esc($post['title']) ?></h3>
                    <p style="color:var(--color-muted); margin-bottom:1rem;">Category: <?= esc($categories[$post['category']]) ?></p>
                    <p style="color:var(--color-muted); margin-bottom:1rem; font-size:0.9rem;"><?= esc($post['excerpt']) ?></p>
                    <a class="btn btn-primary" href="#">Read More</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php partial('footer');