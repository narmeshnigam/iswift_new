<?php
// Home page for iSwift website

require_once __DIR__ . '/core/helpers.php';

// Set page metadata
$meta_title = 'iSwift – Smart Home Automation Simplified';
$meta_desc  = 'Discover luxury smart home automation solutions for Delhi NCR homeowners and professionals. Book a free demo with iSwift today.';
$current_page = 'home';

// Render header
partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <h1>Smart Home. The iSwift Way.</h1>
        <p>Make your home smarter, safer and more efficient — all from a single dashboard powered by iSwift automation.</p>
        <div class="cta-buttons">
            <a class="btn btn-primary" href="<?= url('products.php') ?>">Explore Products</a>
            <a class="btn btn-secondary" href="<?= url('book-demo.php') ?>">Book Free Demo</a>
        </div>
    </section>

    <!-- Solutions Preview -->
    <section class="container" style="padding: 3rem 0;">
        <h2 style="text-align:center; margin-bottom:2rem; color:var(--color-accent);">Our Solutions</h2>
        <div style="display:flex; flex-wrap:wrap; gap:2rem; justify-content:center;">
            <!-- Example solution cards (static placeholders) -->
            <?php
            $solutions = [
                ['title' => 'Smart Locks', 'desc' => 'Keyless entry and enhanced security for your home.', 'slug' => 'smart-locks'],
                ['title' => 'Video Doorbells', 'desc' => '2K HDR vision, motion detection and real‑time alerts.', 'slug' => 'video-doorbells'],
                ['title' => 'Wi‑Fi Mesh Systems', 'desc' => 'Say goodbye to dead zones with reliable, high‑speed Wi‑Fi.', 'slug' => 'wifi-mesh-systems'],
            ];
            foreach ($solutions as $sol): ?>
                <article style="flex:1 1 250px; background: var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.1);">
                    <h3 style="color:var(--color-accent); margin-bottom:0.5rem;"><?= esc($sol['title']) ?></h3>
                    <p style="color:var(--color-muted); margin-bottom:1rem;"><?= esc($sol['desc']) ?></p>
                    <a class="btn btn-primary" href="<?= url('solutions.php') ?>#<?= esc($sol['slug']) ?>">Learn More</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Demo Banner -->
    <section style="background: var(--color-light); padding:3rem 1rem; text-align:center;">
        <h2 style="color:var(--color-accent); margin-bottom:1rem;">Experience iSwift in Action</h2>
        <p style="color:var(--color-muted); margin-bottom:2rem;">Schedule a free on‑site or virtual demo and see how our solutions transform everyday living.</p>
        <a class="btn btn-primary" href="<?= url('book-demo.php') ?>">Book a Demo</a>
    </section>
</main>

<?php
// Render footer
partial('footer');
