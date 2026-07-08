<?php
include "db.php";
include "config.php";

$seoTitle       = "Contact M.V. High School | Charni Road, Mumbai";
$seoDescription = "Contact M.V. High School in Charni Road, Mumbai for admissions, enquiries, address, phone and email details.";
$seoKeywords    = "M.V. High School contact, school contact Mumbai, school address Charni Road, school phone number Mumbai";
$seoCanonical   = BASE_URL . "/contact.php";
$seoImage       = BASE_URL . "/assets/PamphletImage.jpg";
$seoType        = "website";

/* ---- DB — unchanged ---- */
$data = null;
if (isset($conn) && $conn) {
    $res = mysqli_query($conn, "SELECT * FROM school_contact WHERE id=1");
    if ($res) {
        $data = mysqli_fetch_assoc($res);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php include "seo.php"; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="main.css">
</head>
<body>

<header></header>
<script src="load-header.js?v=3" defer></script>

<!-- Hidden SEO content -->
<div class="seo-hidden-content" aria-hidden="true">
  Contact M.V. High School in Charni Road, Mumbai for admissions, school enquiries, address, phone number, and email details.
  <a href="about.php">About Us</a> | <a href="admissions.php">Admissions</a> | <a href="academics.php">Academics</a> | <a href="gallery.php">Campus Life</a>
</div>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="Contact page hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Contact Us</span>
    </nav>
    <h1>Contact M.V. High School</h1>
    <p class="lead">We&rsquo;re here to help — reach out via phone, email or visit us in person.</p>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);" aria-labelledby="contact-heading">
  <div class="container">
    <div class="section-header center" style="margin-bottom:32px;">
      <div class="eyebrow">Get in Touch</div>
      <h2 id="contact-heading" class="no-line" style="color:var(--navy);">Contact Information</h2>
    </div>

    <div class="contact-grid">

      <div class="contact-box">
        <h2>📍 Address</h2>
        <?php if(!empty($data['address'])): ?>
          <p><?= nl2br(htmlspecialchars($data['address'])) ?></p>
        <?php else: ?>
          <p>S.V.P. Road, Charni Road, Bhatwadi, Prarthna Samaj, Mumbai, Maharashtra 400004</p>
        <?php endif; ?>
        <a
          href="https://maps.google.com/?q=M.V.+High+School+Charni+Road+Mumbai"
          target="_blank"
          rel="noopener noreferrer"
          class="btn btn-primary btn-sm"
          style="margin-top:14px;"
          aria-label="Get directions to M.V. High School on Google Maps"
        >Get Directions →</a>
      </div>

      <div class="contact-box">
        <h2>📞 Phone</h2>
        <?php if(!empty($data['phone'])): ?>
          <?php
          // Render phone numbers as clickable links
          $phones = explode("\n", $data['phone']);
          foreach($phones as $ph): $ph = trim($ph); if(!$ph) continue; ?>
            <p><a href="tel:<?= preg_replace('/[^0-9+]/', '', $ph) ?>" style="color:var(--navy-mid);font-weight:600;text-decoration:none;"><?= htmlspecialchars($ph) ?></a></p>
          <?php endforeach; ?>
        <?php else: ?>
          <p><a href="tel:+912247836669" style="color:var(--navy-mid);font-weight:600;text-decoration:none;">022-47836669</a></p>
          <p><a href="tel:+912223865845" style="color:var(--navy-mid);font-weight:600;text-decoration:none;">022-23865845</a></p>
        <?php endif; ?>
        <p style="font-size:13px;color:var(--muted);margin-top:8px;">Monday – Saturday, 7:30 AM – 2:00 PM</p>
      </div>

      <div class="contact-box">
        <h2>✉️ Email</h2>
        <?php if(!empty($data['email'])): ?>
          <p><a href="mailto:<?= htmlspecialchars($data['email']) ?>" style="color:var(--navy-mid);font-weight:600;text-decoration:none;"><?= htmlspecialchars($data['email']) ?></a></p>
        <?php else: ?>
          <p><a href="mailto:principalmvhs70@gmail.com" style="color:var(--navy-mid);font-weight:600;text-decoration:none;">principalmvhs70@gmail.com</a></p>
        <?php endif; ?>
        <p style="font-size:13px;color:var(--muted);margin-top:8px;">For admissions and general enquiries</p>
      </div>

    </div><!-- /contact-grid -->

  </div>
</section>

<!-- HOURS -->
<section class="section-sm" style="background:var(--blue-bg);">
  <div class="container">
    <div style="max-width:600px;margin:0 auto;text-align:center;">
      <h2 style="font-size:1.15rem;color:var(--navy);margin-bottom:16px;">🕐 School Hours</h2>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;text-align:left;max-width:400px;margin:0 auto;">
        <div class="card" style="padding:16px 18px;">
          <div style="font-weight:700;color:var(--ink);font-size:14px;">Monday – Friday</div>
          <div style="color:var(--text-secondary);font-size:13px;">7:30 AM – 2:00 PM</div>
        </div>
        <div class="card" style="padding:16px 18px;">
          <div style="font-weight:700;color:var(--ink);font-size:14px;">Saturday</div>
          <div style="color:var(--text-secondary);font-size:13px;">7:30 AM – 12:30 PM</div>
        </div>
      </div>
      <p style="font-size:12px;color:var(--muted);margin-top:12px;">Hours may vary during holidays and examinations. Please call to confirm.</p>
    </div>
  </div>
</section>

<!-- MAP -->
<section class="section-sm" style="background:var(--surface);padding-bottom:0;">
  <div class="container">
    <h2 style="font-size:1.1rem;color:var(--navy);text-align:center;margin-bottom:16px;">Find Us on the Map</h2>
    <div style="border-radius:var(--radius-md);overflow:hidden;box-shadow:var(--shadow-lg);border:1px solid var(--border);">
      <iframe
        src="https://www.google.com/maps?q=M.V.+High+School+Charni+Road+Mumbai&output=embed"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        style="width:100%;height:420px;border:0;display:block;"
        title="M.V. High School location"
        aria-label="Google Maps showing M.V. High School location in Charni Road, Mumbai"
      ></iframe>
    </div>
    <div style="text-align:center;padding:20px 0;">
      <a
        href="https://maps.google.com/?q=M.V.+High+School+Charni+Road+Mumbai"
        target="_blank"
        rel="noopener noreferrer"
        class="btn btn-primary"
      >Open in Google Maps →</a>
    </div>
  </div>
</section>

<!-- ADMISSIONS CTA -->
<section class="section-sm" style="background:var(--ivory);">
  <div class="container" style="text-align:center;">
    <h2 style="font-size:1.35rem;color:var(--navy);margin-bottom:10px;">Looking for Admissions?</h2>
    <p style="color:var(--text-secondary);margin-bottom:20px;">Admissions are open for <?= CURRENT_AY_LABEL ?>. Click below to submit your enquiry.</p>
    <a href="admissions.php" class="btn btn-primary btn-lg">Apply for Admission →</a>
  </div>
</section>

</main>

<script src="footer.js" defer></script>
</body>
</html>