<?php
// 500 Internal Server Error page

require_once __DIR__ . '/../core/helpers.php';

$meta_title = 'Server Error – iSwift';
$meta_desc  = 'Something went wrong on our end. Please try again later.';
$current_page = '';

http_response_code(500);

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:4rem 0; text-align:center;">
        <h1 style="color:var(--color-accent); font-size:3rem; margin-bottom:1rem;">500</h1>
        <p style="color:var(--color-muted); font-size:1.25rem; margin-bottom:2rem;">We’re experiencing some technical issues. Please bear with us while we resolve the problem.</p>
        <a href="<?= url('') ?>" class="btn btn-primary">Return Home</a>
    </section>
</main>

<?php partial('footer');