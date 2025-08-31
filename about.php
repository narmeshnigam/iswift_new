<?php
// About Us page

require_once __DIR__ . '/../core/helpers.php';

$meta_title = 'About iSwift – Our Story & Vision';
$meta_desc  = 'Learn about iSwift’s mission to simplify smart home automation in Delhi NCR, our team of experts and our commitment to quality and service.';
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0; max-width:800px;">
        <h1 style="color:var(--color-accent);">About iSwift</h1>
        <p style="color:var(--color-muted);">Founded in 2015, iSwift is a Delhi NCR‑based smart home automation company dedicated to making intelligent living accessible to everyone. We design, install and maintain automation systems that blend seamlessly into your home, enhancing comfort, security and energy efficiency.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Our Mission</h2>
        <p style="color:var(--color-muted);">To simplify and elevate everyday living through easy‑to‑use smart home technology, tailored to the unique needs of Indian households.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Our Values</h2>
        <ul style="list-style:none; padding:0;">
            <li style="margin-bottom:1rem; display:flex; align-items:flex-start;">
                <span style="color:var(--color-accent); font-weight:bold; margin-right:0.5rem;">•</span>
                <span style="color:var(--color-muted);">Customer‑first approach – we listen to your needs and design solutions that fit your lifestyle.</span>
            </li>
            <li style="margin-bottom:1rem; display:flex; align-items:flex-start;">
                <span style="color:var(--color-accent); font-weight:bold; margin-right:0.5rem;">•</span>
                <span style="color:var(--color-muted);">Quality & Reliability – we work with trusted brands and follow best practices for installation and support.</span>
            </li>
            <li style="margin-bottom:1rem; display:flex; align-items:flex-start;">
                <span style="color:var(--color-accent); font-weight:bold; margin-right:0.5rem;">•</span>
                <span style="color:var(--color-muted);">Innovation – we stay up‑to‑date with the latest technology trends to provide future‑ready solutions.</span>
            </li>
        </ul>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Meet Our Team</h2>
        <p style="color:var(--color-muted);">Our multidisciplinary team comprises engineers, designers and support specialists who are passionate about smart homes. We share a common goal: to deliver exceptional experiences for our clients.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Certifications & Partnerships</h2>
        <p style="color:var(--color-muted);">iSwift is certified by leading smart home product manufacturers and partners with builders, architects and interior designers across Delhi NCR.</p>
    </section>
</main>

<?php partial('footer');