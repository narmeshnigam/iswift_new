<?php
// Page tailored for homeowners

require_once __DIR__ . '/core/helpers.php';

$meta_title = 'Smart Home Solutions for Homeowners – iSwift';
$meta_desc  = 'Discover how iSwift simplifies life for homeowners in Delhi NCR with smart lighting, security, climate control and more. Achieve peace of mind and comfort with our solutions.';
$current_page = 'homeowners';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">For Homeowners</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">
            Transform your home into a smart living space with iSwift. Our solutions are designed to simplify everyday tasks, enhance security and create a comfortable environment for you and your family.
        </p>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:2rem;">
            <div style="background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Safety & Security</h3>
                <p style="color:var(--color-muted);">Smart locks, video doorbells and sensors keep your home safe and provide peace of mind when you’re away.</p>
            </div>
            <div style="background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Comfort & Convenience</h3>
                <p style="color:var(--color-muted);">Automated lighting, curtains and climate control adapt to your routine, creating a cosy atmosphere at any time.</p>
            </div>
            <div style="background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Energy Savings</h3>
                <p style="color:var(--color-muted);">Monitoring and efficient device management help you save on electricity bills without sacrificing comfort.</p>
            </div>
            <div style="background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Ease of Use</h3>
                <p style="color:var(--color-muted);">Control your home with your voice or smartphone—no technical knowledge required.</p>
            </div>
        </div>
        <div style="text-align:center; margin-top:2rem;">
            <a class="btn btn-primary" href="<?= url('book-demo.php') ?>">Book a Free Consultation</a>
        </div>
    </section>
</main>

<?php partial('footer');
