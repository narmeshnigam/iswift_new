<?php
// Pricing / quotations page

require_once __DIR__ . '/core/helpers.php';

$meta_title = 'Pricing & Quotes – iSwift';
$meta_desc  = 'Explore indicative pricing for iSwift smart home solutions in Delhi NCR. Contact us for personalised quotations based on your requirements.';
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0; max-width:800px;">
        <h1 style="color:var(--color-accent);">Pricing & Quotations</h1>
        <p style="color:var(--color-muted);">Pricing for smart home projects depends on the size of your space, the number of devices and the level of integration you desire. Below we provide indicative price ranges for some common solution bundles. For an accurate quote, please contact us with your project details.</p>
        <table style="width:100%; border-collapse:collapse; margin-top:2rem;">
            <thead>
                <tr style="background:var(--color-light);">
                    <th style="padding:0.75rem; text-align:left; border-bottom:1px solid var(--color-border);">Solution Bundle</th>
                    <th style="padding:0.75rem; text-align:left; border-bottom:1px solid var(--color-border);">Description</th>
                    <th style="padding:0.75rem; text-align:left; border-bottom:1px solid var(--color-border);">Approx. Price (₹)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">Starter Kit</td>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">Smart switch controller for 4 lights + 1 fan, basic app control</td>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">10,000 – 15,000</td>
                </tr>
                <tr>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">Security Pack</td>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">Smart lock, video doorbell, motion sensor & door/window sensor</td>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">25,000 – 35,000</td>
                </tr>
                <tr>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">Comfort Pack</td>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">Automated lighting for 2 rooms, motorized curtains & climate control</td>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">40,000 – 60,000</td>
                </tr>
                <tr>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">Whole Home</td>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">Custom solution for entire home including Wi‑Fi, audio, security and energy monitoring</td>
                    <td style="padding:0.75rem; border-bottom:1px solid var(--color-border);">1,50,000+</td>
                </tr>
            </tbody>
        </table>
        <p style="margin-top:1.5rem; color:var(--color-muted);">These ranges are indicative and subject to change based on the brands selected, installation complexity and home size. Contact us for a personalised proposal.</p>
        <p style="text-align:center; margin-top:2rem;"><a class="btn btn-primary" href="<?= url('book-demo.php') ?>">Get a Quote</a></p>
    </section>
</main>

<?php partial('footer');
