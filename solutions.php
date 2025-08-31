<?php
// Solutions landing page

require_once __DIR__ . '/core/helpers.php';

// Page metadata
$meta_title = 'Smart Home Solutions – iSwift';
$meta_desc  = 'Explore iSwift’s comprehensive range of smart home solutions for lighting, security, climate control and more. Find the perfect automation for your Delhi NCR home.';
$current_page = 'solutions';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">Our Solutions</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">From lighting and climate control to security and entertainment, iSwift offers a portfolio of solutions that work together seamlessly. Click any card below to learn more about each service.</p>
        <div style="display:flex; flex-wrap:wrap; gap:2rem; justify-content:center;">
            <?php
            // Define an array of solutions (slug => [title, description])
            $solutions = [
                'smart-lighting' => ['Smart Lighting', 'Automated lighting scenes, schedules and voice control.'],
                'smart-locks'    => ['Smart Locks', 'Secure, keyless entry for doors and gates.'],
                'video-doorbells'=> ['Video Doorbells', 'See and talk to visitors wherever you are.'],
                'climate-control'=> ['Climate Control', 'Automated thermostats and AC integration.'],
                'curtains-blinds'=> ['Smart Curtains & Blinds', 'Motorized drapes with sunrise/sunset timers.'],
                'security'       => ['Security & Sensors', 'Motion detection, intrusion alerts and more.'],
                'mesh-wifi'      => ['Wi‑Fi & Networking', 'Whole‑home coverage with mesh Wi‑Fi systems.'],
                'entertainment'  => ['Home Entertainment', 'Multi‑room audio, home theatre and voice control.'],
                'energy-monitor' => ['Energy Monitoring', 'Track and reduce your energy consumption.'],
                'voice-assistant'=> ['Voice Assistants', 'Hands‑free control of your entire home.'],
                'retrofit-switch'=> ['Retrofit Switches', 'Smart switches that work with existing wiring.'],
            ];
            foreach ($solutions as $slug => [$title, $desc]): ?>
                <article style="flex:1 1 280px; background: var(--color-light); padding:1.5rem; border-radius:8px; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                    <h3 style="color:var(--color-accent); margin-bottom:0.5rem;"><?= esc($title) ?></h3>
                    <p style="color:var(--color-muted); margin-bottom:1rem;"><?= esc($desc) ?></p>
                    <a class="btn btn-primary" href="<?= url('solution.php?slug=' . $slug) ?>">Learn More</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php partial('footer');
