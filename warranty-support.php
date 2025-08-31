<?php
// Warranty & Support page

require_once __DIR__ . '/../core/helpers.php';

$meta_title = 'Warranty & Support – iSwift';
$meta_desc  = 'Learn about iSwift’s warranty coverage and support services for our smart home products and installations.';
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0; max-width:800px;">
        <h1 style="color:var(--color-accent);">Warranty & Support</h1>
        <p style="color:var(--color-muted);">At iSwift, we stand behind our products and installations. Most products include a 1–3 year manufacturer warranty, and our installation services come with 1 year of on‑site support.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Warranty Coverage</h2>
        <p style="color:var(--color-muted);">Our products are warranted against defects in materials and workmanship. If a device fails within the warranty period under normal use, we will repair or replace it free of charge.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Support Services</h2>
        <p style="color:var(--color-muted);">We provide the following support services:</p>
        <ul style="list-style:none; padding:0;">
            <li style="margin-bottom:0.75rem; display:flex; align-items:flex-start;">
                <span style="color:var(--color-accent); font-weight:bold; margin-right:0.5rem;">•</span>
                <span style="color:var(--color-muted);">Installation and configuration assistance.</span>
            </li>
            <li style="margin-bottom:0.75rem; display:flex; align-items:flex-start;">
                <span style="color:var(--color-accent); font-weight:bold; margin-right:0.5rem;">•</span>
                <span style="color:var(--color-muted);">Device troubleshooting and diagnostics.</span>
            </li>
            <li style="margin-bottom:0.75rem; display:flex; align-items:flex-start;">
                <span style="color:var(--color-accent); font-weight:bold; margin-right:0.5rem;">•</span>
                <span style="color:var(--color-muted);">Firmware updates and feature upgrades.</span>
            </li>
            <li style="margin-bottom:0.75rem; display:flex; align-items:flex-start;">
                <span style="color:var(--color-accent); font-weight:bold; margin-right:0.5rem;">•</span>
                <span style="color:var(--color-muted);">In‑warranty replacements and out‑of‑warranty repairs at nominal charges.</span>
            </li>
        </ul>
        <p style="margin-top:1.5rem; color:var(--color-muted);">For support requests, please email us at <a href="mailto:hi@iswift.in">hi@iswift.in</a> or call +91 96546 40101.</p>
    </section>
</main>

<?php partial('footer');