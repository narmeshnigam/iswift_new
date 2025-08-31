<?php
// Individual service area page

require_once __DIR__ . '/../core/helpers.php';

$slug = $_GET['slug'] ?? '';

// Define city information including title, description and call‑to‑action.  For SEO we mention landmarks and local context.
$areas = [
    'delhi' => [
        'title' => 'Smart Home Automation in Delhi',
        'body'  => 'From historical neighbourhoods like Chandni Chowk to modern addresses in South Delhi, iSwift installs smart home solutions across India’s capital. Our team designs and deploys automation systems that respect heritage homes while delivering cutting‑edge convenience and security.',
    ],
    'noida' => [
        'title' => 'Smart Home Solutions in Noida',
        'body'  => 'We serve homes and offices in Sector 15, Sector 62, Greater Noida West and beyond. Upgrade your flat or villa with intelligent lighting, climate control and security that suits your lifestyle.',
    ],
    'gurugram' => [
        'title' => 'Smart Home Services in Gurugram',
        'body'  => 'Whether you live in DLF Phase 3, Golf Course Road or Sohna Road, iSwift brings luxury automation to your doorstep. Our experts ensure a seamless experience from consultation to installation.',
    ],
    'ghaziabad' => [
        'title' => 'Home Automation in Ghaziabad',
        'body'  => 'Based in Vaishali, we offer installation and support throughout Ghaziabad including Indirapuram, Kaushambi and Raj Nagar. Experience smart living tailored for your family and home.',
    ],
    'faridabad' => [
        'title' => 'Smart Home Systems in Faridabad',
        'body'  => 'Serving homes from Sector 21 to Surajkund, we tailor solutions for apartments and villas in Faridabad. Enjoy integrated automation that elevates comfort and security.',
    ],
    'greater-noida' => [
        'title' => 'Smart Home Automation in Greater Noida',
        'body'  => 'From Jaypee Greens to Pari Chowk, we serve the growing hub of Greater Noida with comprehensive smart home installations. Our team ensures robust networking and seamless automation for large residences.',
    ],
];

// If slug invalid -> 404
if (!isset($areas[$slug])) {
    http_response_code(404);
    $meta_title = 'Service Area Not Found – iSwift';
    $meta_desc  = '';
    $current_page = '';
    partial('header', compact('meta_title', 'meta_desc', 'current_page'));
    echo '<main><section class="container" style="padding:3rem 0"><h1>Service Area Not Found</h1><p>Sorry, we do not have a page for that service area.</p></section></main>';
    partial('footer');
    exit;
}

$area = $areas[$slug];

$meta_title = $area['title'] . ' – iSwift';
$meta_desc  = substr($area['body'], 0, 140);
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="color:var(--color-accent);">
            <?= esc($area['title']) ?>
        </h1>
        <p style="max-width:720px; margin-bottom:1.5rem; color:var(--color-muted);">
            <?= esc($area['body']) ?>
        </p>
        <p style="max-width:720px; margin-bottom:1.5rem; color:var(--color-muted);">
            Contact us today for a consultation or demo. We’ll help you plan the perfect smart home solution for your space in <?= esc(ucwords(str_replace('-', ' ', $slug))) ?>.
        </p>
        <a class="btn btn-primary" href="<?= url('book-demo.php') ?>">Book a Demo</a>
    </section>
</main>

<?php partial('footer');