/**
 * footer.js
 * Builds and injects the site footer.
 * Only verified contact data and social links are included.
 */

(function () {
  'use strict';

  function buildFooter() {
    const year = new Date().getFullYear();

    const html = `
<footer class="footer" role="contentinfo" aria-label="Site footer">

  <div class="container">
    <div class="footer-wrapper">

      <!-- IDENTITY COLUMN -->
      <div class="footer-col footer-identity">
        <div class="footer-logos">
          <img src="assets/EnglishMediumLogo.png" class="footer-logo" alt="M.V. High School — English Medium" width="52" height="52">
          <img src="assets/HindiMediumLogo.png"  class="footer-logo" alt="M.V. High School — Hindi Medium"  width="52" height="52">
        </div>

        <div class="footer-school-name">M.V. High School</div>
        <div class="footer-trust-name">Marwari Vidyalaya Sanchalit Trust</div>

        <p class="footer-tagline" style="margin-top:12px;">
          Nurturing young minds in Charni Road, Mumbai since our founding.
          English Medium (Nursery–10th) &amp; Hindi Medium (8th–10th).
        </p>

        <ul class="footer-contact-list">
          <li>
            <a href="https://maps.google.com/?q=M.V.+High+School+Charni+Road+Mumbai" target="_blank" rel="noopener noreferrer" aria-label="Directions">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
              S.V.P. Road, Charni Road, Bhatwadi, Prarthna Samaj,<br>Mumbai, Maharashtra 400004
            </a>
          </li>
          <li>
            <a href="tel:+912247836669" aria-label="Call school">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012.18 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.09a16 16 0 006 6l.56-.56a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
              022-47836669 &nbsp;/&nbsp; 022-23865845
            </a>
          </li>
          <li>
            <a href="mailto:principalmvhs70@gmail.com" aria-label="Email school">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              principalmvhs70@gmail.com
            </a>
          </li>
        </ul>

        <div class="footer-social" style="margin-top:4px;">
          <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=100057434679919" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.75z"/></svg>
            </a>
            <a href="https://www.instagram.com/mvhs979?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
            </a>
            <a href="https://www.youtube.com/@marwarividyalaya" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.108C19.528 3.545 12 3.545 12 3.545s-7.528 0-9.388.51a3.004 3.004 0 0 0-2.11 2.108C0 8.022 0 12 0 12s0 3.978.502 5.837a3.004 3.004 0 0 0 2.11 2.108c1.86.51 9.388.51 9.388.51s7.53 0 9.388-.51a3.004 3.004 0 0 0 2.11-2.108c.502-1.859.502-5.837.502-5.837s0-3.978-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            </a>
          </div>
        </div>
      </div><!-- /identity -->

      <!-- QUICK LINKS COLUMN -->
      <div class="footer-col">
        <h4>Quick Links</h4>
        <ul class="footer-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="academics.php">Academics</a></li>
          <li><a href="admissions.php">Admissions</a></li>
          <li><a href="faculty.php">Our Faculty</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="monthly-activities.php">Monthly Activities</a></li>
          <li><a href="contact.php">Contact Us</a></li>
        </ul>
      </div><!-- /quick links -->

      <!-- CAMPUS LIFE COLUMN -->
      <div class="footer-col">
        <h4>School Life</h4>
        <ul class="footer-links">
          <li><a href="news-events.php">News &amp; Events</a></li>
          <li><a href="accomplishments.php">Accomplishments</a></li>
          <li><a href="alumni.php">Alumni</a></li>
          <li><a href="gallery.php">Campus Gallery</a></li>
          <li><a href="monthly-activities.php">Activities Calendar</a></li>
          <li><a href="donate.php">Support Our School</a></li>
        </ul>
      </div><!-- /campus life -->

      <!-- ADMISSIONS COLUMN -->
      <div class="footer-col">
        <h4>Admissions</h4>
        <ul class="footer-links">
          <li><a href="admissions.php">Apply Now</a></li>
          <li><a href="admissions.php#eligibility">Eligibility</a></li>
          <li><a href="admissions.php#process">Admission Process</a></li>
          <li><a href="admissions.php#documents">Documents Required</a></li>
        </ul>
        <div style="margin-top:20px;">
          <a href="admissions.php" style="
            display:inline-flex;
            align-items:center;
            gap:6px;
            background:linear-gradient(135deg,#E5A426,#f0c040);
            color:#172033;
            font-weight:800;
            font-size:12px;
            padding:10px 16px;
            border-radius:8px;
            text-decoration:none;
            letter-spacing:0.04em;
            text-transform:uppercase;
            box-shadow:0 2px 8px rgba(229,164,38,0.30);
            transition:all 0.25s ease;
          " onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
            &#127979; Apply for Admission
          </a>
        </div>

        <div style="margin-top:20px;">
          <p style="font-size:12px;color:#4e6278;line-height:1.6;">
            <strong style="color:#94a3b8;">Old Website:</strong><br>
            <a href="http://marwarividyalaya.com" target="_blank" rel="noopener noreferrer" style="color:#667085;">marwarividyalaya.com</a>
          </p>
        </div>
      </div><!-- /admissions -->

    </div><!-- /footer-wrapper -->
  </div><!-- /container -->

  <!-- MAP -->
  <div class="footer-map">
    <iframe
      src="https://www.google.com/maps?q=M.V.+High+School+Charni+Road+Mumbai&output=embed"
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"
      title="M.V. High School location on Google Maps"
      aria-label="Google Maps showing M.V. High School location"
    ></iframe>
  </div>

  <!-- BOTTOM BAR -->
  <div class="footer-bottom">
    <p class="footer-copy">
      &copy; ${year} M.V. High School, Charni Road, Mumbai. All Rights Reserved.
    </p>
    <div class="footer-bottom-links">
      <a href="contact.php">Contact Us</a>
    </div>
  </div>

</footer>
    `;

    document.body.insertAdjacentHTML('beforeend', html);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', buildFooter);
  } else {
    buildFooter();
  }
})();
