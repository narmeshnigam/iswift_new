<?php
// Contact page with address, phone, and a contact form

require_once __DIR__ . '/../core/helpers.php';

$meta_title = 'Contact Us – iSwift';
$meta_desc  = 'Reach out to iSwift for smart home consultations, support and general enquiries. We serve homeowners and professionals across Delhi NCR.';
$current_page = 'contact';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">Contact Us</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">We’d love to hear from you! Whether you’re ready to get started or have questions about our solutions, get in touch using the details or form below.</p>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px,1fr)); gap:2rem;">
            <div style="background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Visit Us</h3>
                <p style="color:var(--color-muted);">1605, S‑3, Cloud 9 Towers, Vaishali, Ghaziabad – 201009</p>
                <p style="color:var(--color-muted);">Mon – Sat: 10 AM to 7 PM</p>
                <p style="color:var(--color-accent);"><a href="https://maps.google.com/?q=Cloud+9,+Apartments+Vaishali,+Ghaziabad" target="_blank" rel="noopener">Get Directions →</a></p>
            </div>
            <div style="background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Call or Email</h3>
                <p style="color:var(--color-muted); margin-bottom:0.5rem;"><strong>Phone:</strong> <a href="tel:+919654640101">+91 96546 40101</a></p>
                <p style="color:var(--color-muted);"><strong>Email:</strong> <a href="mailto:hi@iswift.in">hi@iswift.in</a></p>
                <p style="color:var(--color-muted); margin-top:1rem;"><strong>WhatsApp:</strong> <a href="https://wa.me/919654640101?text=Hi%20iSwift" target="_blank" rel="noopener">Message us</a></p>
            </div>
            <div style="background:var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="color:var(--color-accent); margin-bottom:0.5rem;">Send us a Message</h3>
                <form action="#" method="post" style="display:grid; gap:1rem;">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;">
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;">
                    </div>
                    <div>
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="4" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php partial('footer');