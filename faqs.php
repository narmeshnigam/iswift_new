<?php
// Frequently Asked Questions page

require_once __DIR__ . '/../core/helpers.php';

$meta_title = 'FAQs – iSwift';
$meta_desc  = 'Find answers to common questions about iSwift smart home automation products and services.';
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));

// Sample FAQ data.  In a real site these would be stored in the database and manageable via the admin CMS.
$faqs = [
    [
        'question' => 'Can I upgrade my existing switches to be smart?',
        'answer'   => 'Yes, our retrofit modules fit behind your existing switch plates, turning them into smart switches without the need for rewiring.',
    ],
    [
        'question' => 'Do your products work with voice assistants?',
        'answer'   => 'Most of our solutions are compatible with Alexa, Google Assistant and Siri. Check individual product details for specific integrations.',
    ],
    [
        'question' => 'Is professional installation required?',
        'answer'   => 'While certain plug‑and‑play products can be self‑installed, we recommend professional installation for optimal performance and safety.',
    ],
    [
        'question' => 'Do you offer post‑installation support?',
        'answer'   => 'Absolutely. We offer warranties and ongoing support including maintenance, troubleshooting and upgrades.',
    ],
    [
        'question' => 'Can I see a demo before making a purchase?',
        'answer'   => 'Yes, we provide free demos—both virtual and on‑site—to help you understand how our solutions fit into your home.',
    ],
];
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">Frequently Asked Questions</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">If you can’t find your question here, feel free to <a href="<?= url('contact.php') ?>" style="color:var(--color-accent); text-decoration:underline;">contact us</a>.</p>
        <div style="max-width:800px; margin:0 auto;">
            <?php foreach ($faqs as $faq): ?>
                <div style="margin-bottom:1.5rem;">
                    <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Q: <?= esc($faq['question']) ?></h3>
                    <p style="color:var(--color-muted);">A: <?= esc($faq['answer']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php partial('footer');