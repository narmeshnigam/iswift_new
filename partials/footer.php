<?php
/*
 * Footer partial for the iSwift website.
 *
 * This file closes the `<body>` and `<html>` tags that are opened in
 * `partials/header.php`.  It outputs a call‑to‑action banner, a
 * three‑column footer grid with brand description, quick links and
 * contact details, followed by a bottom strip with copyright and
 * legal links.  Social icons are referenced from the `assets/images`
 * directory – ensure these files exist or replace them with your own.
 */

require_once __DIR__ . '/../core/helpers.php';

$year = date('Y');
?>
<footer class="site-footer">
    <div class="container">
        <!-- CTA banner -->
        <div class="footer-cta">
            <h3 class="footer-cta-title">Need help choosing the right smart solutions?</h3>
            <p class="footer-cta-text">Book a free consultation or message us directly—our experts are ready to help.</p>
            <div class="footer-cta-actions">
                <a href="<?= url('book-demo.php') ?>" class="btn btn-primary">Book Demo</a>
                <a href="https://wa.me/919654640101?text=Hi,%20I%27m%20interested%20in%20iSwift%20smart%20home%20automation." target="_blank" rel="noopener" class="btn btn-secondary">Chat on WhatsApp</a>
            </div>
        </div>
        <!-- Footer grid -->
        <div class="footer-grid">
            <!-- Brand column -->
            <div class="footer-col footer-brand">
                <img src="<?= asset('images/iSwift_logo.png') ?>" alt="iSwift Logo" class="footer-logo" height="48">
                <p class="footer-desc">iSwift is a luxury smart home automation brand offering intelligent solutions to homeowners and professionals. From consultation to installation and support—we handle everything, beautifully.</p>
                <div class="footer-social">
                    <a href="https://wa.me/919654640101" target="_blank" rel="noopener" aria-label="WhatsApp"><img src="<?= asset('images/whatsapp.svg') ?>" alt="WhatsApp" width="30" height="30"></a>
                    <a href="https://www.facebook.com/Secureindia8/" target="_blank" rel="noopener" aria-label="Facebook"><img src="<?= asset('images/facebook.svg') ?>" alt="Facebook" width="30" height="30"></a>
                    <a href="https://www.instagram.com/secureindia.smarthome/" target="_blank" rel="noopener" aria-label="Instagram"><img src="<?= asset('images/instagram.svg') ?>" alt="Instagram" width="30" height="30"></a>
                    <a href="https://www.youtube.com/@smarthomeautomations" target="_blank" rel="noopener" aria-label="YouTube"><img src="<?= asset('images/youtube.svg') ?>" alt="YouTube" width="30" height="30"></a>
                </div>
            </div>
            <!-- Quick links -->
            <div class="footer-col">
                <h4 class="footer-head">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="<?= url('') ?>">Home</a></li>
                    <li><a href="<?= url('solutions.php') ?>">Solutions</a></li>
                    <li><a href="<?= url('projects.php') ?>">Projects</a></li>
                    <li><a href="<?= url('products.php') ?>">Products</a></li>
                    <li><a href="<?= url('learn.php') ?>">Learn</a></li>
                    <li><a href="<?= url('homeowners.php') ?>">Homeowners</a></li>
                    <li><a href="<?= url('professionals.php') ?>">Professionals</a></li>
                    <li><a href="<?= url('contact.php') ?>">Contact</a></li>
                    <li><a href="<?= url('book-demo.php') ?>">Book a Demo</a></li>
                </ul>
            </div>
            <!-- Contact details -->
            <div class="footer-col">
                <h4 class="footer-head">Get in Touch</h4>
                <p class="footer-text">📍 1605, S‑3, Cloud 9 Towers, Vaishali, Ghaziabad – 201009</p>
                <p class="footer-text"><a href="tel:+919654640101">📞 +91 96546 40101</a></p>
                <p class="footer-text"><a href="mailto:hi@iswift.in">✉️ hi@iswift.in</a></p>
                <p class="footer-text">🕒 Mon – Sat: 10 AM to 7 PM</p>
                <p class="footer-text"><a class="footer-directions" href="https://maps.google.com/?q=Cloud+9,+Apartments+Vaishali,+Ghaziabad" target="_blank" rel="noopener">Get Directions →</a></p>
            </div>
        </div>
        <!-- Bottom strip -->
        <div class="footer-bottom">
            <p>© <?= $year ?> iSwift. All rights reserved.</p>
            <div class="footer-legal">
                <a href="<?= url('privacy.php') ?>">Privacy Policy</a>
                <span class="sep">|</span>
                <a href="<?= url('terms.php') ?>">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>
<script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>