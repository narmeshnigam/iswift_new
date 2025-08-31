<?php
// Privacy Policy page

require_once __DIR__ . '/core/helpers.php';

$meta_title = 'Privacy Policy – iSwift';
$meta_desc  = 'Learn how iSwift collects, uses and protects your personal information when you visit our website or use our smart home services.';
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0; max-width:720px;">
        <h1 style="color:var(--color-accent);">Privacy Policy</h1>
        <p style="color:var(--color-muted);">Your privacy is important to us. This policy explains what information we collect, how we use it and your rights regarding your data. We only collect necessary personal information to provide our services and never sell your data to third parties.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Information We Collect</h2>
        <p style="color:var(--color-muted);">We may collect personal details such as your name, email, phone number and address when you contact us or book a demo. We also collect information about how you use our website through cookies and analytics tools.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">How We Use Information</h2>
        <p style="color:var(--color-muted);">We use your information to respond to enquiries, provide customer support, process demo bookings and improve our services. We may occasionally send marketing emails, but you can opt out at any time.</p>
        <h2 style="color:var(--color-accent); margin-top:2rem;">Your Rights</h2>
        <p style="color:var(--color-muted);">You have the right to access, correct or delete your personal information held by us. To exercise any of these rights, please contact our support team.</p>
        <p style="color:var(--color-muted);">For more details on our privacy practices, please contact us at <a href="mailto:hi@iswift.in">hi@iswift.in</a>.</p>
    </section>
</main>

<?php partial('footer');
