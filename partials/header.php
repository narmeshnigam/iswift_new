<?php
/*
 * Header partial for the iSwift website.
 *
 * This file outputs the HTML `<head>` section, opens the `<body>` and
 * renders the main site navigation.  It expects the following
 * variables to be defined by the calling page:
 *
 *   $meta_title (string)    – Page title for the `<title>` element.
 *   $meta_desc  (string)    – Meta description for SEO.
 *   $current_page (string)  – Identifier used to highlight the active nav link.
 */

require_once __DIR__ . '/../core/helpers.php';

// Default values if not provided
$meta_title = $meta_title ?? 'iSwift – Smart Home Automation';
$meta_desc  = $meta_desc  ?? 'Luxury smart home automation solutions in Delhi NCR from iSwift.';
$current_page = $current_page ?? '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($meta_title) ?></title>
    <meta name="description" content="<?= esc($meta_desc) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">

    <!-- Google Tag Manager (placeholder) -->
    <script async src="https://www.googletagmanager.com/gtm.js?id=GTM-XXXXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        // Placeholder GA4 ID – replace with real ID when available
        gtag('config', 'G-XXXXXXXXXX');
    </script>
</head>
<body>
<header class="site-header">
    <div class="container">
        <a href="<?= url('') ?>" class="logo" aria-label="iSwift Home">
            <img src="<?= asset('images/iSwift_logo.png') ?>" alt="iSwift logo" height="48">
        </a>
        <button class="nav-toggle" aria-label="Toggle navigation">☰</button>
        <nav class="main-nav" aria-label="Main navigation">
            <ul class="nav-list">
                <li><a href="<?= url('') ?>" class="<?= $current_page === 'home' ? 'active' : '' ?>">Home</a></li>
                <li><a href="<?= url('solutions.php') ?>" class="<?= $current_page === 'solutions' ? 'active' : '' ?>">Solutions</a></li>
                <li><a href="<?= url('projects.php') ?>" class="<?= $current_page === 'projects' ? 'active' : '' ?>">Projects</a></li>
                <li><a href="<?= url('products.php') ?>" class="<?= $current_page === 'products' ? 'active' : '' ?>">Products</a></li>
                <li><a href="<?= url('learn.php') ?>" class="<?= $current_page === 'learn' ? 'active' : '' ?>">Learn</a></li>
                <li><a href="<?= url('homeowners.php') ?>" class="<?= $current_page === 'homeowners' ? 'active' : '' ?>">Homeowners</a></li>
                <li><a href="<?= url('professionals.php') ?>" class="<?= $current_page === 'professionals' ? 'active' : '' ?>">Professionals</a></li>
                <li><a href="<?= url('contact.php') ?>" class="<?= $current_page === 'contact' ? 'active' : '' ?>">Contact</a></li>
            </ul>
        </nav>
        <div class="header-ctas">
            <a href="<?= url('book-demo.php') ?>" class="btn btn-primary">Book a Demo</a>
        </div>
    </div>
</header>