<?php
// Individual solution detail page.  Expects a `slug` query parameter to
// determine which solution to display.  In a full CMS, this page would
// query the database, but here we define details in a static array for
// demonstration purposes.

require_once __DIR__ . '/../core/helpers.php';

// Determine slug from query
$slug = $_GET['slug'] ?? '';

// Static mapping of solutions to their descriptions and features.  Each
// entry defines the page title, a hero statement, a detailed paragraph
// and an array of bullet benefits.  You can expand this mapping or
// replace it with dynamic data from the database.
$solutions = [
    'smart-lighting' => [
        'title' => 'Smart Lighting',
        'hero'  => 'Illuminate your life effortlessly.',
        'body'  => 'Automated lighting scenes and schedules adapt to your lifestyle. Control every light in your home using a smartphone, voice command or scheduled routines. Dimmers and colour temperature adjustment help set the perfect mood for any occasion.',
        'benefits' => [
            'Create sunrise and sunset scenes for gentle waking and winding down.',
            'Voice control via Alexa, Google Assistant or Siri.',
            'Energy savings with presence sensors and eco‑modes.',
        ],
    ],
    'smart-locks' => [
        'title' => 'Smart Locks',
        'hero'  => 'Keyless entry with uncompromised security.',
        'body'  => 'Replace or retrofit your existing door lock with a smart lock. Issue temporary access codes for guests, monitor entry and exit logs, and lock/unlock your door remotely from anywhere in the world.',
        'benefits' => [
            'Grant or revoke access codes at any time.',
            'See a history of who entered and when.',
            'Integrates with your security system for automatic arming/disarming.',
        ],
    ],
    'video-doorbells' => [
        'title' => 'Video Doorbells',
        'hero'  => 'Know who’s at your door—anytime, anywhere.',
        'body'  => 'Our video doorbells deliver crystal‑clear video, two‑way audio and motion alerts straight to your phone. Receive notifications when packages arrive and deter intruders with pre‑recorded messages.',
        'benefits' => [
            '2K HDR video quality with night vision.',
            'Voice assistant integration for hands‑free viewing.',
            'Motion detection zones to reduce false alerts.',
        ],
    ],
    'climate-control' => [
        'title' => 'Climate Control',
        'hero'  => 'Perfect temperatures, always.',
        'body'  => 'Achieve ultimate comfort and efficiency with smart thermostats and AC controllers. Program schedules, learn your preferences and monitor your energy usage—your home stays comfortable while saving you money.',
        'benefits' => [
            'Remote control from your smartphone.',
            'Adaptive scheduling and occupancy detection.',
            'Integration with HVAC systems and split ACs.',
        ],
    ],
    'curtains-blinds' => [
        'title' => 'Smart Curtains & Blinds',
        'hero'  => 'Let the sunshine in—or keep it out.',
        'body'  => 'Motorized drapery and blinds effortlessly adjust themselves based on time of day, ambient light or your personal schedule. Wake up naturally with sunlight and ensure privacy at night with a simple voice command.',
        'benefits' => [
            'Quiet motors with manual override.',
            'Schedules and remote control via app or voice.',
            'Can retrofit existing curtains and blinds.',
        ],
    ],
    'security' => [
        'title' => 'Security & Sensors',
        'hero'  => 'Peace of mind, 24/7.',
        'body'  => 'Protect your home with motion sensors, door/window contacts, glass break detectors and indoor/outdoor cameras. Receive instant notifications for unusual activity and integrate with sirens and smart locks for a complete security solution.',
        'benefits' => [
            'Instant alerts via phone notifications and SMS.',
            'Pet‑friendly motion sensors reduce false alarms.',
            'Works seamlessly with smart locks and lighting.',
        ],
    ],
    'mesh-wifi' => [
        'title' => 'Wi‑Fi & Networking',
        'hero'  => 'Lightning‑fast connectivity everywhere.',
        'body'  => 'Eliminate dead zones with our premium mesh Wi‑Fi systems. Enjoy high‑speed internet in every corner of your home with seamless hand‑off between nodes and automatic channel management.',
        'benefits' => [
            'Tri‑band technology for interference‑free operation.',
            'Built‑in parental controls and guest networks.',
            'Easy installation and remote diagnostics.',
        ],
    ],
    'entertainment' => [
        'title' => 'Home Entertainment',
        'hero'  => 'Cinematic experiences at home.',
        'body'  => 'Bring the cinema home with multi‑room audio, 4K projectors, surround sound and streaming integration. Control everything with a single remote or your voice.',
        'benefits' => [
            'Synchronised audio in every room.',
            'Support for Apple AirPlay and Chromecast.',
            'Professional installation and calibration.',
        ],
    ],
    'energy-monitor' => [
        'title' => 'Energy Monitoring',
        'hero'  => 'See where your energy goes.',
        'body'  => 'Real‑time monitoring helps you understand your energy consumption and make data‑driven decisions. Identify which appliances draw the most power and set budgets to avoid bill shocks.',
        'benefits' => [
            'Real‑time dashboard accessible via app or web.',
            'Alerts when devices exceed thresholds.',
            'Reports and analytics to lower your bills.',
        ],
    ],
    'voice-assistant' => [
        'title' => 'Voice Assistants',
        'hero'  => 'Your home, at your command.',
        'body'  => 'Integrate with leading voice assistants like Alexa, Google Assistant and Siri to control your entire home hands‑free. From lights and locks to entertainment and sensors, just say the word.',
        'benefits' => [
            'Works with multiple ecosystems.',
            'Routines that trigger multiple actions with one phrase.',
            'Securely control devices without getting off the couch.',
        ],
    ],
    'retrofit-switch' => [
        'title' => 'Retrofit Switches',
        'hero'  => 'Upgrade without rewiring.',
        'body'  => 'Transform your existing switches into smart ones without changing the wiring or switch plates. Retrofit modules sit behind your switches and allow app and voice control of lights and fans.',
        'benefits' => [
            'Non‑intrusive installation behind existing switches.',
            'Compatible with most Indian switchboards.',
            'Control up to 3/4 gang modules.',
        ],
    ],
];

// If slug is invalid, show 404 page
if (!isset($solutions[$slug])) {
    // Set status code for 404
    http_response_code(404);
    $meta_title = 'Solution Not Found – iSwift';
    $meta_desc = 'The requested solution could not be found.';
    $current_page = '';
    partial('header', compact('meta_title', 'meta_desc', 'current_page'));
    echo '<main><section class="container" style="padding:3rem 0"><h1>Solution Not Found</h1><p>Sorry, we couldn\'t find the solution you were looking for.</p></section></main>';
    partial('footer');
    exit;
}

$data = $solutions[$slug];

// Build meta
$meta_title = $data['title'] . ' – iSwift Smart Home Solution';
$meta_desc  = $data['hero'];
$current_page = 'solutions';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="color:var(--color-accent);"><?= esc($data['title']) ?></h1>
        <p style="max-width:720px; margin-bottom:2rem; color:var(--color-muted); font-size:1.125rem;">
            <?= esc($data['body']) ?>
        </p>
        <h2 style="margin-top:2rem; color:var(--color-accent);">Key Benefits</h2>
        <ul style="list-style:none; padding:0; max-width:680px;">
            <?php foreach ($data['benefits'] as $benefit): ?>
                <li style="padding:0.5rem 0; display:flex; align-items:flex-start;">
                    <span style="color:var(--color-accent); margin-right:0.5rem; font-weight:bold;">•</span>
                    <span style="color:var(--color-muted);"><?= esc($benefit) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <div style="margin-top:2rem;">
            <a class="btn btn-primary" href="<?= url('book-demo.php') ?>">Book a Demo</a>
            <a class="btn btn-secondary" href="<?= url('solutions.php') ?>">Back to Solutions</a>
        </div>
    </section>
</main>

<?php partial('footer');