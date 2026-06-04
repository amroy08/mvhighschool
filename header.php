<?php
// Auto-highlight active page (works for all pages)
$currentPage = basename($_SERVER['PHP_SELF']);
function navActive($file) {
  global $currentPage;
  return ($currentPage === $file) ? 'active' : '';
}
?>
<header class="premium-header">

  <!-- TOP ROW -->
  <div class="header-top">

    <div class="logo-box">
      <img src="assets/EnglishMediumLogo.png" class="school-logo" alt="M.V. High School Logo - English Medium">
    </div>

    <div class="school-title-wrap">
      <div class="trust-name">MARWARI VIDYALAYA SANCHALIT TRUST</div>
      <h1 class="school-title">M. V. HIGH SCHOOL</h1>
    </div>

    <div class="logo-box">
      <img src="assets/HindiMediumLogo.jpg" class="school-logo" alt="M.V. High School Logo - Hindi Medium">
    </div>

    <div class="hamburger" onclick="toggleMenu()" aria-label="Toggle Menu" role="button" tabindex="0">
      <span></span><span></span><span></span>
    </div>

  </div>

  <!-- NAV -->
  <nav id="mobileMenu" class="nav-bar">
    <a href="index.php" class="nav-link <?= navActive('index.php'); ?>">Home</a>
    <a href="about.php" class="nav-link <?= navActive('about.php'); ?>">About Us</a>
    <a href="academics.php" class="nav-link <?= navActive('academics.php'); ?>">Academics</a>
    <a href="admissions.php" class="nav-link <?= navActive('admissions.php'); ?>">Admissions</a>
    <a href="faculty.php" class="nav-link <?= navActive('faculty.php'); ?>">Faculty</a>
    <a href="gallery.php" class="nav-link <?= navActive('gallery.php'); ?>">Gallery</a>
    <a href="news-events.php" class="nav-link <?= navActive('news-events.php'); ?>">News & Events</a>
    <a href="accomplishments.php" class="nav-link <?= navActive('accomplishments.php'); ?>">Accomplishments</a>

    <a href="monthly-activities.php" class="nav-link highlight <?= navActive('monthly-activities.php'); ?>">Monthly Activities</a>
    <a href="alumni.php" class="nav-link <?= navActive('alumni.php'); ?>">Alumni</a>

    <a href="contact.php" class="nav-btn contact-btn <?= navActive('contact.php'); ?>">Contact Us</a>
    <a href="donate.php" class="nav-btn donate-btn <?= navActive('donate.php'); ?>">Donate Us</a>
  </nav>

</header>

<script>
function toggleMenu() {
  const menu = document.getElementById("mobileMenu");
  const burger = document.querySelector(".hamburger");
  if (!menu || !burger) return;
  menu.classList.toggle("show-menu");
  burger.classList.toggle("active");
}

// Accessibility: Enter key toggles menu on hamburger
document.addEventListener("DOMContentLoaded", () => {
  const burger = document.querySelector(".hamburger");
  if (!burger) return;
  burger.addEventListener("keydown", (e) => {
    if (e.key === "Enter") toggleMenu();
  });
});
</script>



