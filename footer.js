function loadFooter() {
  const currentYear = new Date().getFullYear();

  const footerHTML = `
  <footer class="footer">
    <div class="container footer-wrapper">

      <!-- LEFT -->
      <div class="footer-left">
        <h3>M.V. High School, Charni Road</h3>
        <p>
          S.V.P. Road, Charni Road, Bhatwadi, Prarthna Samaj,<br>
          Mumbai, Maharashtra 400004
        </p>

        <p><strong> Old Website:</strong> 
          <a href="http://marwarividyalaya.com" target="_blank">
            marwarividyalaya.com
          </a>
        </p>

        <p><strong>Email:</strong> 
          <a href="mailto:principalmvhs70@gmail.com">
            principalmvhs70@gmail.com
          </a>
        </p>

        <p><strong>Phone:</strong> 022-47836669 / 022-23865845</p>
      </div>

      <!-- MIDDLE : QUICK LINKS -->
 <div class="footer-links">
  <h4>Quick Links</h4>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="about.php">About Us</a></li>
    <li><a href="academics.php">Academics</a></li>
    <li><a href="admissions.php">Admissions</a></li>
    <li><a href="faculty.php">Faculty</a></li>
    <li><a href="gallery.php">Gallery</a></li>
    <li><a href="news-events.php">News & Events</a></li>
    <li><a href="accomplishments.php">Accomplishments</a></li>
    <li><a href="monthly-activities.php">Monthly Activities</a></li>
    <li><a href="alumni.php">Alumni</a></li>
    <li><a href="contact.php">Contact Us</a></li>
    <li><a href="donate.php">Donate Us</a></li>
  </ul>
</div>


      <!-- RIGHT -->
      <div class="footer-right">
        <h4>Follow Us</h4>
        <div class="social-icons">
          <a href="https://www.facebook.com/share/1Ea6yaikaF/?mibextid=wwXIfr" target="_blank" aria-label="Facebook">
            <img src="./assets/icons8-facebook-circled-50.png" alt="Facebook">
          </a>
          <a href="https://www.instagram.com/mvhs979?igsh=MTFnZGg3NG80eWlsNW==" target="_blank" aria-label="Instagram">
            <img src="./assets/icons8-instagram-50.png" alt="Instagram">
          </a>
          <a href="https://youtube.com/@marwaravidyalaya?si=EhAwI2ghiyyAqGu5" target="_blank" aria-label="YouTube">
            <img src="./assets/icons8-youtube-50.png" alt="YouTube">
          </a>
        </div>
      </div>

    </div>

    <!-- MAP -->
    <div class="footer-map">
      <iframe 
        src="https://www.google.com/maps?q=M.V.+High+School+Charni+Road+Mumbai&output=embed"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

    <div class="footer-bottom">
      <p>&copy; ${currentYear} M.V. High School. All Rights Reserved.</p>
    </div>
  </footer>
  `;

  document.body.insertAdjacentHTML("beforeend", footerHTML);
}

document.addEventListener("DOMContentLoaded", loadFooter);
