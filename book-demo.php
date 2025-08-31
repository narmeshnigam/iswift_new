<?php
// Book a Demo page – provides a form to schedule a consultation or demo

require_once __DIR__ . '/../core/helpers.php';

$meta_title = 'Book a Free Demo – iSwift';
$meta_desc  = 'Schedule a free smart home consultation with iSwift. Choose your preferred slot, tell us about your project and get personalised recommendations.';
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">Book a Free Demo</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">Tell us about your home or project and we’ll be in touch to schedule a convenient time for an on‑site or virtual demo.</p>
        <form action="#" method="post" style="max-width:600px; margin:0 auto; display:grid; gap:1rem;">
            <div>
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;">
            </div>
            <div>
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;">
            </div>
            <div>
                <label for="city">City</label>
                <select id="city" name="city" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;">
                    <option value="">Select your city</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Noida">Noida</option>
                    <option value="Gurugram">Gurugram</option>
                    <option value="Ghaziabad">Ghaziabad</option>
                    <option value="Faridabad">Faridabad</option>
                    <option value="Greater Noida">Greater Noida</option>
                </select>
            </div>
            <div>
                <label for="project">Project Type</label>
                <select id="project" name="project" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;">
                    <option value="">Select</option>
                    <option value="home">Home</option>
                    <option value="office">Office</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div>
                <label for="message">Additional Notes (Optional)</label>
                <textarea id="message" name="message" rows="4" style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">Submit Booking</button>
        </form>
    </section>
</main>

<?php partial('footer');