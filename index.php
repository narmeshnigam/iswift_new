<?php
// index.php — iSwift Home Page (theme-polished, header/footer untouched)
// ---------------------------------------------------------------------
// • Keeps your existing HEADER and FOOTER exactly as they are.
// • Injects page-specific CSS (iSwift Jupiter+Mercury palette) inside <main> only.
// • Uses real, direct image URLs (Wikimedia Commons) + visible source credits.
// • Content matches the earlier “good content page” you approved.

?>
<?php if (file_exists(__DIR__ . '/header.php')) { include __DIR__ . '/header.php'; } ?>
<main id="main" class="site-main" style="position:relative; z-index:0">
  <style>
    /* iSwift Numerology Theme (Jupiter + Mercury) — page-local overrides only */
    :root{
      --green:#2FBF71;   /* Mercury primary */
      --yellow:#FFD54F;  /* Jupiter primary */
      --sky:#64B5F6;     /* Mercury secondary */
      --saffron:#F4B400; /* Jupiter secondary */

      --surface:#FCFCF8; /* Card/overlay */
      --text:#1F2937;    /* Body/headings */
      --muted:#374151;   /* Secondary text */
      --border:#E5E7EB;  /* Lines */

      --bg-start:#FFF6E0;/* Page background gradient */
      --bg-end:#F0FFF4;

      --radius-lg:16px;
      --radius-md:12px;
      --shadow:0 10px 30px rgba(0,0,0,.06);

      --text-on-yellow:#3B2F00;
    }

    /* Base (scoped to main so header/footer remain unchanged) */
    .site-main{
      color:var(--text);
      background:linear-gradient(180deg,var(--bg-start),var(--bg-end));
      -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale;
      font-family:Inter, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .site-main a{ color:var(--sky); text-decoration:none }
    .site-main a:hover{ text-decoration:underline }
    .muted{ color:var(--muted) !important }

    /* Containers & sections */
    .container{ max-width:1200px; margin-inline:auto; padding-inline:16px }
    section{ padding-block:clamp(24px,6vw,64px); border-top:1px solid rgba(229,231,235,.6) }
    .section-title{ color:var(--saffron); margin:0 0 12px; font-weight:700 }

    /* Grid helpers */
    .grid{ display:grid; gap:clamp(16px,2.5vw,28px) }

    /* Buttons (non-destructive) */
    .btn{ display:inline-flex; align-items:center; gap:8px; border:none;
          border-radius:var(--radius-md); padding:12px 18px; font-weight:700;
          cursor:pointer; transition:transform .15s ease, filter .15s ease, box-shadow .15s ease; text-decoration:none }
    .btn:hover{ transform:translateY(-1px); filter:brightness(.98) }
    .btn-primary{ color:#fff !important; background:linear-gradient(135deg,var(--green), #6EE7A8); box-shadow:0 8px 20px rgba(47,191,113,.25) }
    .btn-ghost{ color:var(--text) !important; background:#fff; border:1px solid var(--border) }
    .btn-secondary{ color:var(--text-on-yellow) !important; background:linear-gradient(135deg,var(--yellow), var(--saffron)); box-shadow:0 8px 20px rgba(244,180,0,.25) }

    /* Cards */
    .card{ background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-lg);
           overflow:hidden; box-shadow:var(--shadow) }
    .card img{ display:block; width:100%; height:auto; border-radius:12px }

    /* Media figure with caption */
    figure.media{ margin:0; border-radius:16px; overflow:hidden; background:#fff; border:1px solid var(--border) }
    figure.media img{ display:block; width:100%; height:auto }
    figure.media figcaption{ font-size:.8rem; color:var(--muted); padding:.5rem .75rem; border-top:1px solid var(--border); background:#fff }
    figure.media figcaption a{ color:var(--muted) }

    /* Eyebrow, headlines, sub */
    .eyebrow{ letter-spacing:.12em; text-transform:uppercase; color:var(--muted); font-weight:700; font-size:.78rem }
    .headline{ font-size:clamp(1.8rem,3.2vw,3rem); line-height:1.15; margin:.35rem 0 1rem }
    .sub{ color:var(--muted); font-size:clamp(.98rem,1.2vw,1.08rem) }

    /* Hero */
    .hero{ background:
             radial-gradient(900px 220px at 10% -40%, rgba(100,181,246,.18), transparent),
             linear-gradient(90deg,var(--bg-start), var(--bg-end)) }
    .hero-wrap{ grid-template-columns:1.1fr .9fr; align-items:center }
    @media (max-width:960px){ .hero-wrap{ grid-template-columns:1fr } }

    /* Services */
    .cards{ grid-template-columns:repeat(auto-fit, minmax(240px,1fr)) }
    .pill{ display:inline-block; margin:.9rem .9rem 0; font-size:.72rem; color:#245f3e; background:#eaf8f1;
           padding:.35rem .6rem; border-radius:999px; border:1px solid rgba(47,191,113,.25) }
    .card h3{ margin:.4rem .9rem .35rem; font-size:1.15rem }
    .card p{ margin:.1rem .9rem 1rem; color:var(--muted) }

    /* Steps */
    .steps{ counter-reset:step }
    .step{ background:#fff; border:1px solid var(--border); border-radius:14px; padding:1rem }
    .step h4{ margin:.2rem 0 .2rem }
    .step:before{
      counter-increment:step; content:counter(step); display:inline-grid; place-items:center;
      width:28px; height:28px; border-radius:8px; background:var(--sky); color:#fff; font-weight:700; margin-right:.6rem
    }

    /* CTA */
    .cta{ background:linear-gradient(180deg, rgba(255,213,79,.18), transparent 65%) }
    .cta-box{ background:#fff; border:1px dashed var(--saffron); border-radius:16px; padding:clamp(18px,2.5vw,26px) }

    /* Brand stripe */
    .brand-stripe{ height:3px; background:linear-gradient(90deg, transparent, var(--green), var(--yellow), var(--sky), transparent); border-radius:3px }
  </style>

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
          <li>Secure device onboarding & network isolation</li>
          <li>Battery backups and surge protection</li>
          <li>Labelled circuits & documentation for easy service</li>
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
