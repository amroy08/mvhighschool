<?php
/*
 * premium-header.php
 * Loaded via load-header.js fetch() into every page's <header> element.
 * Active-link highlighting is done client-side in load-header.js.
 * Do NOT add PHP session or DB logic here — it is fetched independently.
 */
require_once 'config.php';
?>
<a href="#main-content" class="skip-to-content">Skip to main content</a>

<!-- ======================== UTILITY BAR ======================== -->
<div class="utility-bar" aria-hidden="true">
  <div class="container">
    <div class="utility-left">
      <a class="utility-item" href="tel:+912247836669" aria-label="Call school">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          aria-hidden="true">
          <path
            d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012.18 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.09a16 16 0 006 6l.56-.56a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" />
        </svg>
        022-47836669 / 022-23865845
      </a>
      <div class="utility-divider" aria-hidden="true"></div>
      <a class="utility-item" href="mailto:principalmvhs70@gmail.com" aria-label="Email school">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          aria-hidden="true">
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
          <polyline points="22,6 12,13 2,6" />
        </svg>
        principalmvhs70@gmail.com
      </a>
      <div class="utility-divider" aria-hidden="true"></div>
      <span class="utility-item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          aria-hidden="true">
          <circle cx="12" cy="12" r="10" />
          <polyline points="12 6 12 12 16 14" />
        </svg>
        Mon–Fri: 7:30 AM – 2:00 PM
      </span>
    </div>
    <div class="utility-right">
      <div class="utility-social" aria-label="Social media">
        <a href="<?= FACEBOOK_URL ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.75z"/></svg>
        </a>
        <a href="<?= INSTAGRAM_URL ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
        </a>
        <a href="<?= YOUTUBE_URL ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.108C19.528 3.545 12 3.545 12 3.545s-7.528 0-9.388.51a3.004 3.004 0 0 0-2.11 2.108C0 8.022 0 12 0 12s0 3.978.502 5.837a3.004 3.004 0 0 0 2.11 2.108c1.86.51 9.388.51 9.388.51s7.53 0 9.388-.51a3.004 3.004 0 0 0 2.11-2.108c.502-1.859.502-5.837.502-5.837s0-3.978-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
        </a>
      </div>
    </div>
  </div>
</div><!-- /utility-bar -->

<!-- ======================== MAIN HEADER ======================== -->
<header class="premium-header" role="banner">

  <!-- Identity row -->
  <div class="header-top">
    <div class="logo-box">
      <a href="index.php" aria-label="M.V. High School — English Medium Home">
        <img src="assets/EnglishMediumLogo.png" class="school-logo" alt="M.V. High School — English Medium" width="80"
          height="80">
      </a>
    </div>

    <div class="school-title-wrap">
      <div class="trust-name">Marwari Vidyalaya Sanchalit Trust</div>
      <div class="school-title">M. V. High School</div>
      <div class="school-tagline">Charni Road, Mumbai &mdash; English &amp; Hindi Medium</div>
    </div>

    <div class="logo-box">
      <a href="index.php" aria-label="M.V. High School — Hindi Medium Home">
        <img src="assets/HindiMediumLogo.png" class="school-logo" alt="M.V. High School — Hindi Medium" width="80"
          height="80">
      </a>
    </div>

    <!-- Hamburger -->
    <button class="hamburger" id="menuToggle" aria-label="Open navigation menu" aria-expanded="false"
      aria-controls="mobileMenu" type="button">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </button>
  </div><!-- /header-top -->

  <!-- Navigation -->
  <nav id="mobileMenu" class="nav-bar" role="navigation" aria-label="Main navigation">

    <!-- Mobile menu header (visible only on mobile) -->
    <div class="mobile-menu-header" aria-hidden="true">
      <span class="mobile-menu-title">M.V. High School</span>
      <button class="mobile-menu-close" id="menuClose" aria-label="Close navigation menu" type="button">&times;</button>
    </div>

    <a href="index.php" class="nav-link">Home</a>
    <a href="about.php" class="nav-link">About Us</a>
    <a href="academics.php" class="nav-link">Academics</a>
    <a href="admissions.php" class="nav-link">Admissions</a>
    <a href="faculty.php" class="nav-link">Faculty</a>
    <a href="gallery.php" class="nav-link">Gallery</a>
    <a href="news-events.php" class="nav-link">News &amp; Events</a>
    <a href="accomplishments.php" class="nav-link">Accomplishments</a>
    <a href="monthly-activities.php" class="nav-link highlight">Monthly Activities</a>
    <a href="alumni.php" class="nav-link">Alumni</a>

    <div class="nav-divider" aria-hidden="true"></div>

    <a href="contact.php" class="nav-btn contact-btn">Contact Us</a>
    <a href="donate.php" class="nav-btn donate-btn">Donate Us</a>

    <a href="admissions.php" class="nav-admission" id="navAdmissionCta">
      &#127979; Apply for Admission
    </a>

  </nav><!-- /mobileMenu -->

</header><!-- /premium-header -->