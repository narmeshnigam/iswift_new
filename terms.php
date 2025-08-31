<?php
// Terms of Use page

require_once __DIR__ . '/core/helpers.php';

$meta_title = 'Terms of Use – iSwift';
$meta_desc  = 'Review the terms and conditions for using the iSwift website and services.';
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0; max-width:720px;">
        <h1 style="color:var(--color-accent);">Terms of Use</h1>
        <p style="color:var(--color-muted);">By accessing or using the iSwift website, you agree to abide by these terms of use. Please read them carefully. If you do not agree with our terms, please do not use our website or services.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Use of Website</h2>
        <p style="color:var(--color-muted);">The content provided on this site is for informational purposes only. You agree not to misuse the site or copy any content without permission. We reserve the right to modify or discontinue the site at any time.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Intellectual Property</h2>
        <p style="color:var(--color-muted);">All intellectual property rights in the website and its content belong to iSwift or its licensors. You may not use our trademarks, logos or content without prior written consent.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Limitation of Liability</h2>
        <p style="color:var(--color-muted);">We do our best to provide accurate information, but we do not warrant that the content is error‑free. We are not liable for any damages arising from your use of the site.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Changes to Terms</h2>
        <p style="color:var(--color-muted);">We may revise these terms at any time by updating this page. Continued use of the site constitutes acceptance of the updated terms.</p>
    </section>
</main>

<?php partial('footer');
