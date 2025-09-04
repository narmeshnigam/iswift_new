<?php
// Book a Demo page — persists submissions to DB

require_once __DIR__ . '/core/helpers.php';

// Handle submission
$errors = [];
$sent = isset($_GET['sent']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $city    = trim($_POST['city'] ?? '');
    $project = trim($_POST['project'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '')    $errors['name'] = 'Please enter your name.';
    if ($phone === '')   $errors['phone'] = 'Please enter your phone number.';
    if ($city === '')    $errors['city'] = 'Please choose your city.';
    if ($project === '') $errors['project'] = 'Please choose the project type.';

    if (!$errors) {
        // DB bootstrap
        $pdo = $pdo ?? null;
        $cfg = __DIR__ . '/admin/includes/config.php';
        $dbf = __DIR__ . '/admin/includes/db.php';
        if (is_file($cfg)) require_once $cfg;
        if (is_file($dbf)) require_once $dbf;
        if (!($pdo instanceof PDO) && function_exists('db')) {
            $maybe = db();
            if ($maybe instanceof PDO) $pdo = $maybe;
        }
        if (!($pdo instanceof PDO)) {
            $host = defined('DB_HOST') ? DB_HOST : ($DB_HOST ?? ($config['db']['host'] ?? '127.0.0.1'));
            $nameDb = defined('DB_NAME') ? DB_NAME : ($DB_NAME ?? ($config['db']['name'] ?? 'iswift'));
            $user = defined('DB_USER') ? DB_USER : ($DB_USER ?? ($config['db']['user'] ?? 'root'));
            $pass = defined('DB_PASS') ? DB_PASS : ($DB_PASS ?? ($config['db']['pass'] ?? ''));
            try {
                $pdo = new PDO("mysql:host={$host};dbname={$nameDb};charset=utf8mb4", $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (Throwable $e) {
                $errors['db'] = 'Could not connect to database.';
            }
        }

        if (!isset($errors['db']) && ($pdo instanceof PDO)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO demo_bookings
                    (name, phone, city, project_type, message, source_page, referer, user_agent, ip_address, status)
                    VALUES (:name,:phone,:city,:ptype,:message,'book-demo.php',:referer,:ua,:ip,'new')");
                $stmt->execute([
                    ':name'    => $name,
                    ':phone'   => $phone,
                    ':city'    => $city,
                    ':ptype'   => $project,
                    ':message' => ($message !== '' ? $message : null),
                    ':referer' => $_SERVER['HTTP_REFERER']  ?? null,
                    ':ua'      => $_SERVER['HTTP_USER_AGENT'] ?? null,
                    ':ip'      => $_SERVER['REMOTE_ADDR']   ?? null,
                ]);
                header('Location: ' . url('book-demo.php') . '?sent=1');
                exit;
            } catch (Throwable $e) {
                $errors['db'] = 'Failed to save your booking.';
            }
        }
    }
}

$meta_title = 'Book a Free Demo — iSwift';
$meta_desc  = 'Schedule a free smart home consultation with iSwift. Choose your preferred slot, tell us about your project and get personalised recommendations.';
$current_page = '';

partial('header', compact('meta_title', 'meta_desc', 'current_page'));
?>

<main>
    <section class="container" style="padding:3rem 0">
        <h1 style="text-align:center; color:var(--color-accent);">Book a Free Demo</h1>
        <p style="max-width:720px; margin:0 auto 2rem; text-align:center; color:var(--color-muted);">Tell us about your home or project and we’ll be in touch to schedule a convenient time for an on‑site or virtual demo.</p>

        <?php if ($sent): ?>
            <div style="max-width:600px; margin:0 auto 1rem; padding:0.75rem; border:1px solid #d1e7dd; background:#f0fff4; color:#0f5132; border-radius:6px;">Thanks! We’ll call you soon to schedule your demo.</div>
        <?php endif; ?>
        <?php if ($errors): ?>
            <div style="max-width:600px; margin:0 auto 1rem; padding:0.75rem; border:1px solid #f5c2c7; background:#fff5f5; color:#842029; border-radius:6px;">
                <?= esc(reset($errors)) ?>
            </div>
        <?php endif; ?>

        <form action="" method="post" style="max-width:600px; margin:0 auto; display:grid; gap:1rem;">
            <div>
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" value="<?= esc($_POST['name'] ?? '') ?>" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;">
            </div>
            <div>
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="<?= esc($_POST['phone'] ?? '') ?>" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;">
            </div>
            <div>
                <label for="city">City</label>
                <select id="city" name="city" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;">
                    <option value="">Select your city</option>
                    <?php $cities=['Delhi','Noida','Gurugram','Ghaziabad','Faridabad','Greater Noida']; foreach($cities as $c){ $sel=((($_POST['city']??'')===$c)?'selected':''); echo '<option value="'.esc($c).'" '.$sel.'>'.esc($c).'</option>'; } ?>
                </select>
            </div>
            <div>
                <label for="project">Project Type</label>
                <select id="project" name="project" required style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;">
                    <option value="">Select</option>
                    <option value="home"  <?= (($_POST['project'] ?? '')==='home')  ? 'selected' : '' ?>>Home</option>
                    <option value="office" <?= (($_POST['project'] ?? '')==='office') ? 'selected' : '' ?>>Office</option>
                    <option value="other" <?= (($_POST['project'] ?? '')==='other') ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
            <div>
                <label for="message">Additional Notes (Optional)</label>
                <textarea id="message" name="message" rows="4" style="width:100%; padding:0.75rem; border:1px solid var(--color-border); border-radius:4px;"><?= esc($_POST['message'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">Submit Booking</button>
        </form>
    </section>
    
</main>

<?php partial('footer');
