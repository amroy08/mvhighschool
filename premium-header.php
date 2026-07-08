<?php
/*
 * premium-header.php
 * Loaded via load-header.js fetch() into every page's <header> element.
 * Active-link highlighting is done client-side in load-header.js.
 * Do NOT add PHP session or DB logic here — it is fetched independently.
 */
?>
<a href="#main-content" class="skip-to-content">Skip to main content</a>

<!-- ======================== UTILITY BAR ======================== -->
<div class="utility-bar" aria-hidden="true">
  <div class="container">
    <div class="utility-left">
      <a class="utility-item" href="tel:+912247836669" aria-label="Call school">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012.18 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.09a16 16 0 006 6l.56-.56a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        022-47836669 / 022-23865845
      </a>
      <div class="utility-divider" aria-hidden="true"></div>
      <a class="utility-item" href="mailto:principalmvhs70@gmail.com" aria-label="Email school">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        principalmvhs70@gmail.com
      </a>
      <div class="utility-divider" aria-hidden="true"></div>
      <span class="utility-item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Mon–Sat: 7:30 AM – 2:00 PM
      </span>
    </div>
    <div class="utility-right">
      <div class="utility-social" aria-label="Social media">
        <a href="https://www.facebook.com/share/1Ea6yaikaF/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
          <img src="assets/icons8-facebook-circled-50.png" alt="Facebook" width="14" height="14">
        </a>
        <a href="https://www.instagram.com/mvhs979?igsh=MTFnZGg3NG80eWlsNW==" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
          <img src="assets/icons8-instagram-50.png" alt="Instagram" width="14" height="14">
        </a>
        <a href="https://youtube.com/@marwaravidyalaya?si=EhAwI2ghiyyAqGu5" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
          <img src="assets/icons8-youtube-50.png" alt="YouTube" width="14" height="14">
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
        <img
          src="assets/EnglishMediumLogo.png"
          class="school-logo"
          alt="M.V. High School — English Medium"
          width="80"
          height="80"
        >
      </a>
    </div>

    <div class="school-title-wrap">
      <div class="trust-name">Marwari Vidyalaya Sanchalit Trust</div>
      <div class="school-title">M. V. High School</div>
      <div class="school-tagline">Charni Road, Mumbai &mdash; English &amp; Hindi Medium</div>
    </div>

    <div class="logo-box">
      <a href="index.php" aria-label="M.V. High School — Hindi Medium Home">
        <img
          src="assets/HindiMediumLogo.png"
          class="school-logo"
          alt="M.V. High School — Hindi Medium"
          width="80"
          height="80"
        >
      </a>
    </div>

    <!-- Hamburger -->
    <button
      class="hamburger"
      id="menuToggle"
      aria-label="Open navigation menu"
      aria-expanded="false"
      aria-controls="mobileMenu"
      type="button"
    >
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

    <a href="index.php"               class="nav-link">Home</a>
    <a href="about.php"               class="nav-link">About Us</a>
    <a href="academics.php"           class="nav-link">Academics</a>
    <a href="admissions.php"          class="nav-link">Admissions</a>
    <a href="faculty.php"             class="nav-link">Faculty</a>
    <a href="gallery.php"             class="nav-link">Gallery</a>
    <a href="news-events.php"         class="nav-link">News &amp; Events</a>
    <a href="accomplishments.php"     class="nav-link">Accomplishments</a>
    <a href="monthly-activities.php"  class="nav-link highlight">Monthly Activities</a>
    <a href="alumni.php"              class="nav-link">Alumni</a>

    <div class="nav-divider" aria-hidden="true"></div>

    <a href="contact.php"  class="nav-btn contact-btn">Contact Us</a>
    <a href="donate.php"   class="nav-btn donate-btn">Donate Us</a>

    <a href="admissions.php" class="nav-admission" id="navAdmissionCta">
      &#127979; Apply for Admission
    </a>

  </nav><!-- /mobileMenu -->

</header><!-- /premium-header -->
