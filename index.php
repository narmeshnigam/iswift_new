<?php
// index.php — iSwift Home Page (header/footer untouched, external CSS only)
// Requires: /assets/css/iswift-theme.css (load after your existing CSS)
?>
<?php if (file_exists(__DIR__ . '/header.php')) { include __DIR__ . '/header.php'; } ?>

<link rel="stylesheet" href="/assets/css/iswift-theme.css">

<main id="main" class="site-main">
  <!-- HERO -->
  <section class="hero">
    <div class="container grid hero-wrap">
      <div>
        <div class="eyebrow">iSwift Home</div>
        <h1 class="headline">Smarter living, secured access & seamless comfort</h1>
        <p class="sub">We design and install complete smart-home solutions: smart locks, video doorbells, automated curtains, and whole-home Wi-Fi—professionally set up and tuned for your space.</p>
        <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:14px">
          <a href="/contact" class="btn btn-primary">Get a free site survey</a>
          <a href="/services" class="btn btn-ghost">Explore services</a>
        </div>
        <div class="muted" style="margin-top:10px">Licensed Installers • Local Support • Warranty Backed</div>
      </div>
      <figure class="media">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/Google_Home_Hub_on_table.jpg" alt="Smart display on a table (Google Nest Hub)">
        <figcaption>Source:
          <a href="https://upload.wikimedia.org/wikipedia/commons/e/e1/Google_Home_Hub_on_table.jpg" target="_blank" rel="noopener">Wikimedia Commons</a>
        </figcaption>
      </figure>
    </div>
  </section>

  <!-- SERVICES -->
  <section id="services">
    <div class="container">
      <div class="grid" style="align-items:end; grid-template-columns:1fr; gap:10px">
        <div>
          <div class="eyebrow">What we do</div>
          <h2 class="section-title" style="font-size:clamp(1.4rem,2.5vw,2rem)">End-to-end smart-home installation</h2>
          <p class="sub">From product selection to cabling, mounting, app setup, and training—done right the first time.</p>
        </div>
      </div>

      <div class="grid cards" style="margin-top:18px">
        <!-- Smart Locks -->
        <article class="card">
          <span class="pill">Access & Security</span>
          <figure class="media">
            <img src="https://upload.wikimedia.org/wikipedia/commons/8/88/Nest_Yale_%28cropped%29.jpg" alt="Nest x Yale smart lock close-up">
            <figcaption>Source:
              <a href="https://upload.wikimedia.org/wikipedia/commons/8/88/Nest_Yale_%28cropped%29.jpg" target="_blank" rel="noopener">Wikimedia Commons</a>
            </figcaption>
          </figure>
          <h3>Smart Locks</h3>
          <p>Keyless entry, shared codes for guests, activity logs, and door status—integrated with your phone and smart home.</p>
        </article>

        <!-- Video Doorbells -->
        <article class="card">
          <span class="pill">Safety & Awareness</span>
          <figure class="media">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Ring_Video_Doorbell_2.jpg" alt="Ring video doorbell mounted on door frame">
            <figcaption>Source:
              <a href="https://upload.wikimedia.org/wikipedia/commons/5/53/Ring_Video_Doorbell_2.jpg" target="_blank" rel="noopener">Wikimedia Commons</a>
            </figcaption>
          </figure>
          <h3>Video Doorbells</h3>
          <p>See and talk to visitors from anywhere, get motion alerts, and strengthen your perimeter security.</p>
        </article>

        <!-- Automated Curtains -->
        <article class="card">
          <span class="pill">Comfort & Light</span>
          <figure class="media">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/94/Home_Curtains.jpg" alt="Curtains framing a sunlit window">
            <figcaption>Source:
              <a href="https://upload.wikimedia.org/wikipedia/commons/9/94/Home_Curtains.jpg" target="_blank" rel="noopener">Wikimedia Commons</a>
            </figcaption>
          </figure>
          <h3>Automated Curtains</h3>
          <p>Schedule shades to open with sunrise, close for privacy, and tie into scenes for movie night.</p>
        </article>

        <!-- Whole-Home Wi-Fi -->
        <article class="card">
          <span class="pill">Connectivity</span>
          <figure class="media">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/94/Wi-Fi_mesh_system_Deco_M9_Plus.jpg" alt="TP-Link Deco M9 Plus mesh Wi-Fi unit">
            <figcaption>Source:
              <a href="https://upload.wikimedia.org/wikipedia/commons/9/94/Wi-Fi_mesh_system_Deco_M9_Plus.jpg" target="_blank" rel="noopener">Wikimedia Commons</a>
            </figcaption>
          </figure>
          <h3>Whole-Home Wi-Fi</h3>
          <p>Reliable coverage in every room with professionally planned mesh systems and interference mitigation.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- FEATURED PROJECT / TRUST -->
  <section>
    <div class="container grid" style="grid-template-columns:1.1fr .9fr; align-items:center">
      <div>
        <div class="eyebrow">Why homeowners choose iSwift</div>
        <h2 class="section-title" style="font-size:clamp(1.4rem,2.4vw,2rem)">Design-first, installer-led</h2>
        <ul class="sub" style="margin:0; padding-left:1rem; line-height:1.65">
          <li>On-site assessment and signal mapping</li>
          <li>Neat cabling, tidy finish, and device grouping</li>
          <li>Training for the whole family + post-install support</li>
          <li>Works with major ecosystems (Google, Apple, Amazon)</li>
        </ul>
        <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:14px">
          <a href="/portfolio" class="btn btn-ghost">View recent installs</a>
          <a href="/contact" class="btn btn-primary">Book a consultation</a>
        </div>
      </div>

      <figure class="media">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Living_room_Germany_2006.jpg" alt="Modern living room interior with sectional sofa">
        <figcaption>Source:
          <a href="https://upload.wikimedia.org/wikipedia/commons/9/9e/Living_room_Germany_2006.jpg" target="_blank" rel="noopener">Wikimedia Commons</a>
        </figcaption>
      </figure>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section id="process">
    <div class="container">
      <div class="eyebrow">How it works</div>
      <h2 class="section-title" style="font-size:clamp(1.4rem,2.4vw,2rem)">From walkthrough to wow</h2>
      <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr))">
        <div class="step"><h4>Free site survey</h4><p class="sub">We measure doors, map Wi-Fi, and check power points to plan the perfect setup.</p></div>
        <div class="step"><h4>Tailored proposal</h4><p class="sub">Clear pricing with good-better-best options for your budget and priorities.</p></div>
        <div class="step"><h4>Pro installation</h4><p class="sub">Clean, safe, and warrantied. We’ll configure apps and create scenes.</p></div>
        <div class="step"><h4>Aftercare</h4><p class="sub">We’re one message away for tweaks, add-ons, or future upgrades.</p></div>
      </div>
    </div>
  </section>

  <!-- TECHNICAL SHOWCASE -->
  <section aria-labelledby="panel-title">
    <div class="container grid" style="grid-template-columns:.9fr 1.1fr; align-items:center">
      <figure class="media">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/65/Smarthome_electrical_panel.jpg" alt="Smart home electrical panel with modules and labeled circuits">
        <figcaption>Source:
          <a href="https://upload.wikimedia.org/wikipedia/commons/6/65/Smarthome_electrical_panel.jpg" target="_blank" rel="noopener">Wikimedia Commons</a>
        </figcaption>
      </figure>
      <div>
        <div class="eyebrow" id="panel-title">Under the hood</div>
        <h2 class="section-title" style="font-size:clamp(1.4rem,2.2vw,1.9rem)">Reliability by design</h2>
        <p class="sub">Behind the scenes, we balance wireless convenience with hard-wired reliability where it matters.</p>
        <ul class="sub" style="margin:0; padding-left:1rem; line-height:1.65">
          <li>Secure device onboarding &amp; network isolation</li>
          <li>Battery backups and surge protection</li>
          <li>Labelled circuits &amp; documentation for easy service</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta">
    <div class="container cta-box">
      <div class="grid" style="grid-template-columns:1.1fr .9fr; align-items:center">
        <div>
          <div class="eyebrow">Ready to get started?</div>
          <h2 class="section-title" style="font-size:clamp(1.5rem,2.6vw,2.1rem)">Book a free in-home consultation</h2>
          <p class="sub">Tell us about your space and goals—we’ll bring options you can see and feel.</p>
          <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:12px">
            <a href="/contact" class="btn btn-primary">Schedule now</a>
            <a href="/pricing" class="btn btn-ghost">See pricing</a>
          </div>
        </div>
        <figure class="media">
          <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Ring_Video_Doorbell_2.jpg" alt="Video doorbell product shot">
          <figcaption>Source:
            <a href="https://upload.wikimedia.org/wikipedia/commons/5/53/Ring_Video_Doorbell_2.jpg" target="_blank" rel="noopener">Wikimedia Commons</a>
          </figcaption>
        </figure>
      </div>
      <div class="brand-stripe" style="margin-top:12px"></div>
      <p class="muted" style="margin-top:10px; font-size:.9rem">All images are for illustrative purposes only. © iSwift.</p>
    </div>
  </section>
</main>

<?php if (file_exists(__DIR__ . '/footer.php')) { include __DIR__ . '/footer.php'; } ?>
