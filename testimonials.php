<?php
// Testimonials page

require_once __DIR__ . '/../core/helpers.php';

$meta_title = 'Client Testimonials – iSwift';
$meta_desc  = 'See what our clients in Delhi NCR say about their experience with iSwift’s smart home installations.';
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));

// Sample testimonials (static). In a real system these would come from a database.
$testimonials = [
    [
        'name' => 'Anita Sharma',
        'city' => 'Delhi',
        'text' => 'Thanks to iSwift, controlling my home is as easy as saying "Hey Alexa". Their team was professional and patient, and I couldn’t be happier with the results.',
    ],
    [
        'name' => 'Rajesh Gupta',
        'city' => 'Noida',
        'text' => 'The retrofit switches were installed in just one day. My family loves the convenience and we saved on rewiring costs. Highly recommended!',
    ],
    [
        'name' => 'Nisha Arora',
        'city' => 'Gurugram',
        'text' => 'Our video doorbell and smart locks give me peace of mind when I’m travelling. Customer service is responsive and helpful.',
    ],
];
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">Client Testimonials</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">Hear from homeowners and professionals who have embraced iSwift’s smart home solutions.</p>
        <div style="display:flex; flex-wrap:wrap; gap:2rem; justify-content:center;">
            <?php foreach ($testimonials as $t): ?>
                <article style="flex:1 1 280px; background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                    <p style="color:var(--color-muted); font-style:italic; margin-bottom:1rem;">“<?= esc($t['text']) ?>”</p>
                    <p style="color:var(--color-accent); font-weight:bold; margin-bottom:0.25rem;">
                        <?= esc($t['name']) ?>
                    </p>
                    <p style="color:var(--color-muted); font-size:0.875rem;">
                        <?= esc($t['city']) ?>
                    </p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php partial('footer');