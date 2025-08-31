<?php
// Page for architects, interior designers and builders

require_once __DIR__ . '/core/helpers.php';

$meta_title = 'Partnerships for Professionals – iSwift';
$meta_desc  = 'Collaborate with iSwift and deliver cutting‑edge smart home solutions to your clients. Learn about our partnership program for architects, interior designers and builders in Delhi NCR.';
$current_page = 'professionals';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">Partner with iSwift</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">Enhance your projects with integrated smart home technology. Join our partnership program and enjoy exclusive benefits, training and support from our team.</p>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:2rem;">
            <div style="background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Why Partner with Us</h3>
                <p style="color:var(--color-muted);">Access to premium automation products, attractive commissions and dedicated support for your projects.</p>
            </div>
            <div style="background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Training & Resources</h3>
                <p style="color:var(--color-muted);">Receive hands‑on training and marketing assets to promote smart home solutions to your clients.</p>
            </div>
            <div style="background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Dedicated Support</h3>
                <p style="color:var(--color-muted);">Our team assists from concept to installation to ensure your project’s success and client satisfaction.</p>
            </div>
        </div>
        <div style="text-align:center; margin-top:2rem;">
            <a class="btn btn-primary" href="<?= url('contact.php') ?>">Enquire About Partnerships</a>
        </div>
    </section>
</main>

<?php partial('footer');
