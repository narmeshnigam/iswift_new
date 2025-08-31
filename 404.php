<?php
// 404 Not Found page

require_once __DIR__ . '/../core/helpers.php';

$meta_title = 'Page Not Found – iSwift';
$meta_desc  = 'The page you are looking for cannot be found.';
$current_page = '';

http_response_code(404);

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:4rem 0; text-align:center;">
        <h1 style="color:var(--color-accent); font-size:3rem; margin-bottom:1rem;">404</h1>
        <p style="color:var(--color-muted); font-size:1.25rem; margin-bottom:2rem;">Oops! The page you’re looking for does not exist or has been moved.</p>
        <a href="<?= url('') ?>" class="btn btn-primary">Return Home</a>
    </section>
</main>

<?php partial('footer');