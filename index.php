<?php
include "db.php";
include "config.php";

/* ---- SEO ---- */
$seoTitle       = "Best School in Charni Road, Mumbai | M.V. High School";
$seoDescription = "M.V. High School in Charni Road, Mumbai offers English Medium from Nursery to 10th and Hindi Medium for Secondary 8th–10th. Admissions open for " . CURRENT_AY_LABEL . " with smart classrooms, sports, and holistic development.";
$seoKeywords    = "best school in Charni Road, school in Mumbai, English medium school Mumbai, Hindi medium school Mumbai, nursery to 10th school, admissions open Mumbai";
$seoCanonical   = BASE_URL . "/";
$seoImage       = BASE_URL . "/assets/PamphletImage.jpg";
$seoType        = "website";

/* ---- DB QUERIES — unchanged from original ---- */
$hero        = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM home_hero WHERE id=1"));
$hero_images = mysqli_query($conn, "SELECT * FROM home_hero_images ORDER BY id DESC");
$choose_us   = mysqli_query($conn, "SELECT * FROM choose_us ORDER BY id ASC");
$updates     = mysqli_query($conn, "SELECT * FROM news_events WHERE status='Published' ORDER BY event_date DESC, id DESC LIMIT 6");

/* Additional queries for homepage sections */
$principal   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_principal ORDER BY id DESC LIMIT 1"));
$gallery_albums = mysqli_query($conn, "SELECT * FROM gallery_albums ORDER BY id DESC LIMIT 6");
$accomplishments = mysqli_query($conn, "SELECT * FROM accomplishments ORDER BY id DESC LIMIT 4");
$alumni_feat = mysqli_query($conn, "SELECT * FROM alumni ORDER BY id DESC LIMIT 4");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php include "seo.php"; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="/favicon.png">

  <!-- Fonts preconnect -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Main stylesheet (includes all design system partials) -->
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="styles.css">

  <style>
  /* ======================================================
     HOMEPAGE — SPECIFIC STYLES
     ====================================================== */

  /* ---- HERO ---- */
  .hero-section {
    background: linear-gradient(160deg, #0c1f45 0%, var(--navy) 50%, #1C3986 100%);
    min-height: clamp(480px, 70vh, 680px);
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    padding: clamp(2.5rem, 6vw, 5rem) 0;
  }

  .hero-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 60% 80% at 70% 50%, rgba(229,164,38,0.07) 0%, transparent 70%),
      radial-gradient(ellipse 40% 60% at 10% 20%, rgba(255,255,255,0.03) 0%, transparent 60%);
    pointer-events: none;
  }

  .hero-wrap {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    align-items: center;
    gap: clamp(2rem, 4vw, 4rem);
    position: relative;
    z-index: 1;
  }

  .hero-content {}

  .hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold-light);
    margin-bottom: 16px;
    background: rgba(229,164,38,0.15);
    border: 1px solid rgba(229,164,38,0.25);
    padding: 5px 14px;
    border-radius: var(--radius-pill);
  }

  .hero-content h1 {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 5vw, 3.25rem);
    font-weight: 800;
    color: #fff;
    line-height: 1.18;
    margin-bottom: 18px;
    letter-spacing: -0.02em;
  }

  .hero-content h1 em {
    font-style: normal;
    color: var(--gold-light);
  }

  .hero-subtitle {
    font-size: clamp(1rem, 1.8vw, 1.15rem);
    color: rgba(255,255,255,0.75);
    line-height: 1.7;
    margin-bottom: 28px;
    max-width: 520px;
  }

  .hero-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 28px;
  }

  .hero-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: rgba(255,255,255,0.80);
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    padding: 5px 12px;
    border-radius: var(--radius-pill);
  }

  .hero-pill::before {
    content: '✓';
    color: var(--gold-light);
    font-weight: 800;
  }

  .hero-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }

  .hero-media {
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: 0 25px 60px rgba(0,0,0,0.40);
    position: relative;
  }

  /* ---- TRUST STRIP ---- */
  .trust-strip {
    background: var(--navy);
    padding: 0;
    border-bottom: 1px solid rgba(255,255,255,0.06);
  }

  .trust-strip-inner {
    display: flex;
    align-items: stretch;
    justify-content: center;
    flex-wrap: wrap;
  }

  .trust-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 22px 28px;
    text-align: center;
    border-right: 1px solid rgba(255,255,255,0.08);
    flex: 1;
    min-width: 160px;
    gap: 6px;
    transition: background var(--transition-fast);
  }

  .trust-item:last-child { border-right: none; }
  .trust-item:hover { background: rgba(255,255,255,0.04); }

  .trust-icon {
    font-size: 24px;
    line-height: 1;
    margin-bottom: 2px;
  }

  .trust-label {
    font-family: var(--font-body);
    font-size: 13px;
    font-weight: 700;
    color: #fff;
    line-height: 1.3;
  }

  .trust-sub {
    font-size: 11px;
    color: rgba(255,255,255,0.55);
    font-weight: 500;
  }

  /* ---- WELCOME SECTION ---- */
  .welcome-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: clamp(2rem, 4vw, 4rem);
  }

  .welcome-content h2 {
    color: var(--navy);
    margin-bottom: 16px;
  }

  .welcome-content p {
    margin-bottom: 14px;
    line-height: 1.8;
  }

  .welcome-image {
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    position: relative;
  }

  .welcome-image img {
    width: 100%;
    height: clamp(280px, 35vw, 420px);
    object-fit: cover;
    transition: transform 0.5s ease;
  }

  .welcome-image:hover img { transform: scale(1.03); }

  /* ---- WHY CHOOSE US ---- */
  .why-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 22px;
    margin-top: 10px;
  }

  .why-card {
    cursor: pointer;
    text-decoration: none;
    color: inherit;
    display: block;
  }

  /* ---- ACADEMIC PROGRAMMES ---- */
  .programme-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 10px;
  }

  .programme-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 26px 20px;
    text-align: center;
    box-shadow: var(--shadow);
    transition: var(--transition);
    text-decoration: none;
    color: inherit;
    display: block;
    position: relative;
    overflow: hidden;
  }

  .programme-card::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--gold), var(--gold-light));
    transform: scaleX(0);
    transition: transform 0.4s ease;
    transform-origin: left;
  }

  .programme-card:hover::before { transform: scaleX(1); }

  .programme-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-md);
    border-color: var(--gold);
  }

  .programme-card .prog-icon {
    font-size: 2.2rem;
    margin-bottom: 12px;
    display: block;
    line-height: 1;
  }

  .programme-card h3 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: 6px;
  }

  .programme-card p {
    font-size: 13px;
    color: var(--text-secondary);
    line-height: 1.5;
  }

  /* ---- PRINCIPAL MESSAGE ---- */
  .principal-section {
    background: linear-gradient(135deg, var(--ivory) 0%, var(--blue-bg) 100%);
  }

  .principal-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    display: grid;
    grid-template-columns: 280px 1fr;
    max-width: 900px;
    margin: 0 auto;
  }

  .principal-photo-col {
    background: linear-gradient(180deg, var(--navy) 0%, var(--navy-dark) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 32px 24px;
    gap: 14px;
    text-align: center;
  }

  .principal-photo {
    width: 140px;
    height: 160px;
    object-fit: cover;
    border-radius: var(--radius);
    border: 3px solid rgba(229,164,38,0.4);
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
  }

  .principal-photo-placeholder {
    width: 140px;
    height: 160px;
    border-radius: var(--radius);
    background: rgba(255,255,255,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
  }

  .principal-name {
    font-family: var(--font-heading);
    font-size: 1.05rem;
    font-weight: 700;
    color: #fff;
    line-height: 1.3;
  }

  .principal-designation {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--gold-light);
    opacity: 0.9;
  }

  .principal-message-col {
    padding: 36px 36px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .principal-quote {
    font-size: clamp(1rem, 1.5vw, 1.1rem);
    color: var(--text-secondary);
    line-height: 1.85;
    margin-bottom: 20px;
    font-style: italic;
    border-left: 3px solid var(--gold);
    padding-left: 18px;
  }

  /* ---- NEWS CARDS ---- */
  .news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 22px;
    margin-top: 12px;
  }

  .news-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 22px;
    box-shadow: var(--shadow);
    transition: var(--transition);
    cursor: pointer;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .news-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
    border-color: var(--gold);
  }

  .news-card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
  }

  .news-card-date {
    font-size: 12px;
    color: var(--muted);
    font-weight: 600;
  }

  .news-card-title {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.4;
  }

  .news-card-link {
    font-size: 13px;
    font-weight: 700;
    color: var(--navy-mid);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: auto;
    transition: color var(--transition-fast);
  }

  .news-card-link:hover { color: var(--gold-dark); }

  /* ---- GALLERY PREVIEW ---- */
  .gallery-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 18px;
    margin-top: 12px;
  }

  .gallery-preview-card {
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    cursor: pointer;
    position: relative;
    aspect-ratio: 4/3;
    background: var(--border-light);
    transition: var(--transition);
  }

  .gallery-preview-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }

  .gallery-preview-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }

  .gallery-preview-card:hover img { transform: scale(1.07); }

  .gallery-preview-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(transparent 40%, rgba(10,30,60,0.85) 100%);
    display: flex;
    align-items: flex-end;
    padding: 14px;
    opacity: 0;
    transition: opacity var(--transition);
  }

  .gallery-preview-card:hover .gallery-preview-overlay { opacity: 1; }

  .gallery-preview-name {
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    line-height: 1.3;
  }

  /* ---- ACCOMPLISHMENTS ---- */
  .acc-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-top: 12px;
  }

  .acc-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-left: 4px solid var(--gold);
    border-radius: var(--radius);
    padding: 22px;
    box-shadow: var(--shadow);
    transition: var(--transition);
    cursor: pointer;
    text-decoration: none;
    color: inherit;
    display: block;
  }

  .acc-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-left-color: var(--navy); }

  .acc-card h3 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: 8px;
    line-height: 1.4;
  }

  .acc-card p {
    font-size: 13px;
    color: var(--text-secondary);
    line-height: 1.6;
  }

  /* ---- ALUMNI SPOTLIGHT ---- */
  .alumni-spot-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 22px;
    margin-top: 12px;
  }

  .alumni-spot-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px 18px;
    text-align: center;
    box-shadow: var(--shadow);
    transition: var(--transition);
    text-decoration: none;
    color: inherit;
    display: block;
  }

  .alumni-spot-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); border-color: var(--gold); }

  .alumni-spot-photo {
    width: 90px;
    height: 100px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    margin: 0 auto 12px;
    display: block;
    border: 2px solid var(--border);
  }

  .alumni-spot-photo-placeholder {
    width: 90px;
    height: 100px;
    border-radius: var(--radius-sm);
    background: var(--blue-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    font-size: 2.5rem;
  }

  .alumni-spot-name {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 4px;
  }

  .alumni-spot-batch {
    font-size: 12px;
    color: var(--muted);
    margin-bottom: 6px;
  }

  .alumni-spot-achievement {
    font-size: 12px;
    font-weight: 600;
    color: var(--navy-mid);
  }

  /* ---- ADMISSIONS CTA BAND ---- */
  .admission-cta-band {
    background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 60%, var(--navy-mid) 100%);
    padding: clamp(3rem, 7vw, 5rem) 0;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .admission-cta-band::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 70% 80% at 50% 50%, rgba(229,164,38,0.08) 0%, transparent 70%);
    pointer-events: none;
  }

  .admission-cta-band h2 {
    color: #fff;
    margin-bottom: 12px;
    font-size: clamp(1.6rem, 3.5vw, 2.5rem);
  }

  .admission-cta-band h2::after { display: none; }

  .admission-cta-band .lead {
    color: rgba(255,255,255,0.75);
    margin: 0 auto 28px;
    max-width: 560px;
  }

  .admission-cta-actions {
    display: flex;
    gap: 14px;
    justify-content: center;
    flex-wrap: wrap;
  }

  /* ---- CONTACT PREVIEW ---- */
  .contact-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-top: 12px;
  }

  .contact-preview-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px 20px;
    box-shadow: var(--shadow);
    transition: var(--transition);
    text-align: center;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }

  .contact-preview-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: var(--gold); }

  .contact-preview-icon {
    width: 50px;
    height: 50px;
    background: var(--blue-bg);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
  }

  .contact-preview-card h3 {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--navy);
  }

  .contact-preview-card p {
    font-size: 13px;
    color: var(--text-secondary);
    line-height: 1.5;
  }

  /* ---- ADMISSION POPUP ---- */
  .admission-layout {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 24px;
    max-width: 900px !important;
    max-height: 90vh;
    overflow: hidden;
  }

  .admission-form {
    overflow-y: auto;
    max-height: 85vh;
    padding-right: 10px;
  }

  .admission-form h2 {
    font-size: 1.35rem;
    margin-bottom: 14px;
    color: var(--navy);
  }

  .admission-pamphlet {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .admission-pamphlet img {
    width: 100%;
    max-height: 85vh;
    object-fit: contain;
    border-radius: var(--radius-sm);
    box-shadow: var(--shadow-md);
  }

  /* ---- RESPONSIVE ---- */
  @media (max-width: 960px) {
    .hero-wrap { grid-template-columns: 1fr; text-align: center; }
    .hero-content h1 { font-size: clamp(1.7rem, 5vw, 2.5rem); }
    .hero-subtitle { margin-left: auto; margin-right: auto; }
    .hero-pills { justify-content: center; }
    .hero-actions { justify-content: center; }
    .welcome-grid { grid-template-columns: 1fr; }
    .principal-card { grid-template-columns: 1fr; max-width: 520px; }
    .principal-photo-col { padding: 28px 20px; }
  }

  @media (max-width: 768px) {
    .trust-strip-inner { flex-direction: column; }
    .trust-item { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); }
    .trust-item:last-child { border-bottom: none; }
    .modal-box.admission-layout {
      grid-template-columns: 1fr;
      width: 100%;
      height: 100%;
      max-height: 100vh;
      border-radius: 0;
      padding: 16px;
      overflow-y: auto;
    }
    .admission-form { max-height: none; overflow: visible; padding-right: 0; }
    .close-modal { position: fixed; top: 12px; right: 15px; z-index: 10001; background: #fff; border-radius: 50%; padding: 4px 10px; }
    .admission-pamphlet { order: -1; }
    .admission-pamphlet img { max-height: 240px; }
  }
  </style>
</head>
<body>

<!-- HEADER -->
<header></header>
<script src="load-header.js?v=3" defer></script>

<!-- Success / Error banners from form submission -->
<?php if(isset($_GET['success'])): ?>
<div class="alert alert-success" style="text-align:center;border-radius:0;border-left:none;border-right:none;padding:14px 24px;" role="alert">
  ✅ Your admission enquiry was submitted successfully. Our team will contact you shortly.
</div>
<?php endif; ?>

<?php if(isset($_GET['error'])): ?>
<div class="alert alert-error" style="text-align:center;border-radius:0;border-left:none;border-right:none;padding:14px 24px;" role="alert">
  ⚠️ Something went wrong. Please fill all required fields and try again.
</div>
<?php endif; ?>

<main id="main-content">

<!-- ===================================================================
     1. HERO SECTION
==================================================================== -->
<section class="hero-section" aria-label="School hero">
  <div class="container">
    <div class="hero-wrap">

      <div class="hero-content">
        <div class="hero-eyebrow">&#127979; Admissions Open &mdash; <?= CURRENT_AY_LABEL ?></div>

        <h1>
          Shaping Future Leaders<br>
          at <em>M.V. High School</em><br>
          <span style="color:rgba(255,255,255,0.80);font-size:0.65em;font-weight:600;letter-spacing:0em;">Charni Road, Mumbai</span>
        </h1>

        <p class="hero-subtitle">
          <?php if(!empty($hero['subtitle'])): ?>
            <?= htmlspecialchars($hero['subtitle']) ?>
          <?php else: ?>
            A legacy of academic excellence, holistic development and strong values — nurturing every child to reach their true potential.
          <?php endif; ?>
        </p>

        <div class="hero-pills">
          <span class="hero-pill">Nursery to Grade 10</span>
          <span class="hero-pill">English &amp; Hindi Medium</span>
          <span class="hero-pill">Smart Classrooms</span>
          <span class="hero-pill">Sports &amp; Activities</span>
        </div>

        <div class="hero-actions">
          <a href="admissions.php" class="btn btn-primary btn-lg">Apply for Admission</a>
          <a href="academics.php"  class="btn btn-outline-white">Explore Academics</a>
          <a href="gallery.php"    class="btn btn-outline-white btn-sm" style="align-self:center;">View Campus</a>
        </div>
      </div>

      <div class="hero-media">
        <div class="slideshow-container">
          <?php
          $slide_count = 0;
          while($img = mysqli_fetch_assoc($hero_images)) {
            $slide_count++;
            ?>
            <img
              class="slide-img"
              src="<?= htmlspecialchars($img['image']) ?>"
              alt="M.V. High School students and campus activities"
              <?= $slide_count === 1 ? 'loading="eager"' : 'loading="lazy"' ?>
              width="600"
              height="420"
            >
          <?php } ?>
          <?php if($slide_count === 0): ?>
            <img
              src="assets/PamphletImage.jpg"
              alt="M.V. High School"
              class="slide-img"
              loading="eager"
              width="600"
              height="420"
            >
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===================================================================
     2. TRUST STRIP
==================================================================== -->
<section class="trust-strip" aria-label="School highlights">
  <div class="container p-0" style="padding:0;max-width:100%;">
    <div class="trust-strip-inner">
      <div class="trust-item">
        <div class="trust-icon">🎓</div>
        <div class="trust-label">Nursery to Grade 10</div>
        <div class="trust-sub">Complete schooling journey</div>
      </div>
      <div class="trust-item">
        <div class="trust-icon">📚</div>
        <div class="trust-label">English &amp; Hindi Medium</div>
        <div class="trust-sub">Bilingual education</div>
      </div>
      <div class="trust-item">
        <div class="trust-icon">👩‍🏫</div>
        <div class="trust-label">Experienced Faculty</div>
        <div class="trust-sub">Qualified educators</div>
      </div>
      <div class="trust-item">
        <div class="trust-icon">🏆</div>
        <div class="trust-label">Holistic Development</div>
        <div class="trust-sub">Sports, arts, academics</div>
      </div>
      <div class="trust-item">
        <div class="trust-icon">🖥️</div>
        <div class="trust-label">Smart Classrooms</div>
        <div class="trust-sub">Modern learning tools</div>
      </div>
    </div>
  </div>
</section>

<!-- ===================================================================
     3. WELCOME SECTION
==================================================================== -->
<section class="section" style="background:var(--surface);" aria-labelledby="welcome-heading">
  <div class="container">
    <div class="welcome-grid">

      <div class="welcome-content">
        <div class="eyebrow">About Our School</div>
        <h2 id="welcome-heading">Welcome to M.V. High School</h2>
        <p>
          Established under the Marwari Vidyalaya Sanchalit Trust, M.V. High School has been a pillar of quality education
          in Charni Road, Mumbai. We offer English Medium education from Nursery to Grade 10 and Hindi Medium education
          for Secondary classes from Grade 8 to Grade 10.
        </p>
        <p>
          Our school blends strong academic foundations with co-curricular activities, sports, smart board classrooms,
          audio-visual learning, and personal development programmes to create well-rounded, confident students.
        </p>
        <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:20px;">
          <a href="about.php" class="btn btn-secondary">Learn More About Us</a>
          <a href="admissions.php" class="btn btn-gold-ghost">Admissions Open</a>
        </div>
      </div>

      <div class="welcome-image">
        <img
          src="assets/PamphletImage.jpg"
          alt="M.V. High School campus and student activities"
          loading="lazy"
          width="560"
          height="420"
        >
      </div>

    </div>
  </div>
</section>

<!-- ===================================================================
     4. WHY CHOOSE US
==================================================================== -->
<section class="section" style="background:var(--blue-bg);" aria-labelledby="why-heading">
  <div class="container">
    <div class="section-header center">
      <div class="eyebrow">Why Choose Us</div>
      <h2 id="why-heading" class="no-line" style="color:var(--navy);">Why M.V. High School?</h2>
      <p class="lead" style="margin:10px auto 0;">A caring culture, strong academics and a vibrant campus life.</p>
    </div>

    <div class="why-grid">
      <?php
      $choose_us_count = 0;
      while($row = mysqli_fetch_assoc($choose_us)) {
        $choose_us_count++;
        $link = "#";
        if (stripos($row['title'], 'faculty') !== false)   $link = "faculty.php";
        if (stripos($row['title'], 'holistic') !== false)  $link = "gallery.php";
        if (stripos($row['title'], 'facilit') !== false)   $link = "gallery.php";
        if (stripos($row['title'], 'academic') !== false)  $link = "academics.php";
      ?>
      <a href="<?= $link ?>" class="why-card feature-card">
        <div class="icon">
          <i class="<?= htmlspecialchars($row['icon']) ?>" aria-hidden="true"></i>
        </div>
        <h4><?= htmlspecialchars($row['title']) ?></h4>
        <p><?= htmlspecialchars($row['description']) ?></p>
      </a>
      <?php } ?>

      <?php if($choose_us_count === 0): ?>
      <!-- Static fallback if admin hasn't added cards yet -->
      <div class="feature-card">
        <div class="icon"><span>🎓</span></div>
        <h4>Academic Excellence</h4>
        <p>Strong curriculum from Nursery to Grade 10 with qualified, experienced educators.</p>
      </div>
      <div class="feature-card">
        <div class="icon"><span>🏅</span></div>
        <h4>Holistic Development</h4>
        <p>Sports, arts, cultural activities and personal development programmes.</p>
      </div>
      <div class="feature-card">
        <div class="icon"><span>🖥️</span></div>
        <h4>Smart Facilities</h4>
        <p>Smart board classrooms and audio-visual learning tools for modern education.</p>
      </div>
      <?php endif; ?>
    </div>

  </div>
</section>

<!-- ===================================================================
     5. ACADEMIC PROGRAMMES
==================================================================== -->
<section class="section" style="background:var(--surface);" aria-labelledby="programmes-heading">
  <div class="container">
    <div class="section-header center">
      <div class="eyebrow">Academics</div>
      <h2 id="programmes-heading" class="no-line" style="color:var(--navy);">Our Academic Programmes</h2>
      <p class="lead" style="margin:10px auto 0;">Structured learning pathways from Pre-Primary through Secondary.</p>
    </div>

    <div class="programme-grid">
      <a href="academics.php" class="programme-card">
        <span class="prog-icon">🌱</span>
        <h3>Pre-Primary</h3>
        <p>Nursery, Jr. KG &amp; Sr. KG — play-based learning and foundational skills.</p>
      </a>
      <a href="academics.php" class="programme-card">
        <span class="prog-icon">📖</span>
        <h3>Primary (Grades 1–5)</h3>
        <p>Core subjects, interactive learning and building strong academic foundations.</p>
      </a>
      <a href="academics.php" class="programme-card">
        <span class="prog-icon">🔬</span>
        <h3>Secondary (Grades 6–10)</h3>
        <p>Board-oriented curriculum, STEM focus and career-readiness preparation.</p>
      </a>
      <a href="academics.php" class="programme-card">
        <span class="prog-icon">🇬🇧</span>
        <h3>English Medium</h3>
        <p>Nursery to Grade 10 — English instruction with holistic development.</p>
      </a>
      <a href="academics.php" class="programme-card">
        <span class="prog-icon">🇮🇳</span>
        <h3>Hindi Medium</h3>
        <p>Secondary (Grade 8–10) — quality education in Hindi medium.</p>
      </a>
    </div>

    <div style="text-align:center;margin-top:28px;">
      <a href="academics.php" class="btn btn-secondary">Explore Full Curriculum →</a>
    </div>
  </div>
</section>

<!-- ===================================================================
     6. PRINCIPAL'S MESSAGE (only shown if data exists)
==================================================================== -->
<?php if($principal): ?>
<section class="section principal-section" aria-labelledby="principal-heading">
  <div class="container">
    <div class="section-header center">
      <div class="eyebrow">Leadership</div>
      <h2 id="principal-heading" class="no-line" style="color:var(--navy);">Message from the Principal</h2>
    </div>

    <div class="principal-card">
      <div class="principal-photo-col">
        <?php if(!empty($principal['image'])): ?>
          <img
            src="assets/<?= htmlspecialchars($principal['image']) ?>"
            alt="<?= htmlspecialchars($principal['name']) ?> — Principal, M.V. High School"
            class="principal-photo"
            loading="lazy"
            width="140"
            height="160"
          >
        <?php else: ?>
          <div class="principal-photo-placeholder">👤</div>
        <?php endif; ?>
        <div class="principal-name"><?= htmlspecialchars($principal['name']) ?></div>
        <div class="principal-designation"><?= htmlspecialchars($principal['designation'] ?? 'Principal') ?></div>
      </div>

      <div class="principal-message-col">
        <p class="principal-quote">
          <?php
          $msg = $principal['message'] ?? '';
          $excerpt = mb_strlen($msg) > 380 ? mb_substr($msg, 0, 380) . '...' : $msg;
          echo nl2br(htmlspecialchars($excerpt));
          ?>
        </p>
        <a href="about.php#principal" class="btn btn-secondary btn-sm">Read Full Message →</a>
      </div>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ===================================================================
     7. LATEST NEWS & EVENTS
==================================================================== -->
<section class="section" style="background:var(--blue-bg);" aria-labelledby="news-heading">
  <div class="container">
    <div class="section-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px;">
      <div>
        <div class="eyebrow">Updates</div>
        <h2 id="news-heading" class="no-line" style="color:var(--navy);">Latest News &amp; Events</h2>
      </div>
      <a href="news-events.php" class="btn btn-ghost btn-sm">View All →</a>
    </div>

    <?php
    $has_news = false;
    $news_items = [];
    while($u = mysqli_fetch_assoc($updates)) {
      $has_news = true;
      $news_items[] = $u;
    }
    ?>

    <?php if($has_news): ?>
    <div class="news-grid">
      <?php foreach($news_items as $u): ?>
        <?php
        $dateText = '';
        if (!empty($u['event_date'])) {
          $t = strtotime($u['event_date']);
          if ($t) $dateText = date('d M Y', $t);
        }
        ?>
        <div class="news-card" onclick="location.href='news-details.php?id=<?= (int)$u['id'] ?>'" role="link" tabindex="0" aria-label="<?= htmlspecialchars($u['title']) ?>">
          <div class="news-card-meta">
            <span class="badge"><?= htmlspecialchars($u['status'] ?? 'Published') ?></span>
            <?php if($dateText): ?><span class="news-card-date">📅 <?= htmlspecialchars($dateText) ?></span><?php endif; ?>
          </div>
          <div class="news-card-title"><?= htmlspecialchars($u['title']) ?></div>
          <a href="news-details.php?id=<?= (int)$u['id'] ?>" class="news-card-link">View Details →</a>
        </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state"><p>No announcements at the moment. Check back soon.</p></div>
    <?php endif; ?>

  </div>
</section>

<!-- ===================================================================
     8. GALLERY PREVIEW
==================================================================== -->
<?php
$gallery_count = 0;
$gallery_items = [];
while($al = mysqli_fetch_assoc($gallery_albums)) {
  $gallery_count++;
  $gallery_items[] = $al;
}
?>
<?php if($gallery_count > 0): ?>
<section class="section" style="background:var(--surface);" aria-labelledby="gallery-heading">
  <div class="container">
    <div class="section-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px;">
      <div>
        <div class="eyebrow">Campus Life</div>
        <h2 id="gallery-heading" class="no-line" style="color:var(--navy);">Campus Life &amp; Activities</h2>
      </div>
      <a href="gallery.php" class="btn btn-ghost btn-sm">View All Albums →</a>
    </div>

    <div class="gallery-preview-grid">
      <?php foreach($gallery_items as $al):
        $path  = ltrim($al['cover_image'], '/');
        $cover = '/' . str_replace('%2F','/', rawurlencode($path));
        $slug  = urlencode($al['slug']);
        $name  = htmlspecialchars($al['album_name']);
      ?>
      <div
        class="gallery-preview-card"
        onclick="location.href='gallery-view.php?slug=<?= $slug ?>'"
        role="link"
        tabindex="0"
        aria-label="View <?= $name ?> gallery"
      >
        <img src="<?= $cover ?>" alt="M.V. High School — <?= $name ?>" loading="lazy" width="400" height="300">
        <div class="gallery-preview-overlay">
          <div class="gallery-preview-name"><?= $name ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ===================================================================
     9. ACCOMPLISHMENTS
==================================================================== -->
<?php
$acc_count = 0;
$acc_items = [];
while($ac = mysqli_fetch_assoc($accomplishments)) {
  $acc_count++;
  $acc_items[] = $ac;
}
?>
<?php if($acc_count > 0): ?>
<section class="section" style="background:var(--ivory);" aria-labelledby="acc-heading">
  <div class="container">
    <div class="section-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px;">
      <div>
        <div class="eyebrow">Achievements</div>
        <h2 id="acc-heading" class="no-line" style="color:var(--navy);">School Accomplishments</h2>
      </div>
      <a href="accomplishments.php" class="btn btn-ghost btn-sm">View All →</a>
    </div>

    <div class="acc-grid">
      <?php foreach($acc_items as $ac): ?>
      <a href="accomplishment-details.php?slug=<?= urlencode($ac['slug']) ?>" class="acc-card">
        <h3><?= htmlspecialchars($ac['title']) ?></h3>
        <p><?= htmlspecialchars(mb_substr($ac['description'] ?? '', 0, 90)) ?>...</p>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ===================================================================
     10. ALUMNI SPOTLIGHT
==================================================================== -->
<?php
$alumni_count = 0;
$alumni_items = [];
while($al = mysqli_fetch_assoc($alumni_feat)) {
  $alumni_count++;
  $alumni_items[] = $al;
}
?>
<?php if($alumni_count > 0): ?>
<section class="section" style="background:var(--surface);" aria-labelledby="alumni-heading">
  <div class="container">
    <div class="section-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px;">
      <div>
        <div class="eyebrow">Our Community</div>
        <h2 id="alumni-heading" class="no-line" style="color:var(--navy);">Alumni Spotlight</h2>
      </div>
      <a href="alumni.php" class="btn btn-ghost btn-sm">View All Alumni →</a>
    </div>

    <div class="alumni-spot-grid">
      <?php foreach($alumni_items as $al): ?>
      <a href="alumni-details.php?id=<?= (int)$al['id'] ?>" class="alumni-spot-card">
        <?php if(!empty($al['photo'])): ?>
          <img
            src="assets/<?= htmlspecialchars($al['photo']) ?>"
            alt="<?= htmlspecialchars($al['name']) ?>"
            class="alumni-spot-photo"
            loading="lazy"
            width="90"
            height="100"
            onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
          >
          <div class="alumni-spot-photo-placeholder" style="display:none;">👤</div>
        <?php else: ?>
          <div class="alumni-spot-photo-placeholder">👤</div>
        <?php endif; ?>
        <div class="alumni-spot-name"><?= htmlspecialchars($al['name']) ?></div>
        <?php if(!empty($al['passing_year'])): ?>
          <div class="alumni-spot-batch">Batch <?= htmlspecialchars($al['passing_year']) ?></div>
        <?php endif; ?>
        <?php if(!empty($al['achievement'])): ?>
          <div class="alumni-spot-achievement"><?= htmlspecialchars(mb_substr($al['achievement'], 0, 60)) ?></div>
        <?php endif; ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ===================================================================
     11. ADMISSIONS CTA BAND
==================================================================== -->
<section class="admission-cta-band" aria-labelledby="cta-heading">
  <div class="container" style="position:relative;z-index:1;">
    <div class="eyebrow" style="justify-content:center;color:var(--gold-light);">Admissions <?= CURRENT_AY_LABEL ?></div>
    <h2 id="cta-heading">Ready to Join M.V. High School?</h2>
    <p class="lead">
      Admissions are open for Academic Year <?= CURRENT_AY_LABEL ?>. English Medium (Nursery–Grade 10)
      and Hindi Medium (Grade 8–10) seats are available.
    </p>
    <div class="admission-cta-actions">
      <a href="admissions.php" class="btn btn-primary btn-lg">Apply for Admission</a>
      <a href="tel:+912247836669" class="btn btn-outline-white">📞 Call School</a>
      <a href="contact.php" class="btn btn-outline-white">Contact Us</a>
    </div>
  </div>
</section>

<!-- ===================================================================
     12. CONTACT PREVIEW
==================================================================== -->
<section class="section" style="background:var(--surface);" aria-labelledby="contact-heading">
  <div class="container">
    <div class="section-header center">
      <div class="eyebrow">Find Us</div>
      <h2 id="contact-heading" class="no-line" style="color:var(--navy);">Get in Touch</h2>
      <p class="lead" style="margin:8px auto 0;">We&rsquo;re located in Charni Road, Mumbai. Come visit us or reach out any time.</p>
    </div>

    <div class="contact-preview-grid">
      <a href="https://maps.google.com/?q=M.V.+High+School+Charni+Road+Mumbai" target="_blank" rel="noopener noreferrer" class="contact-preview-card">
        <div class="contact-preview-icon">📍</div>
        <h3>Our Address</h3>
        <p>S.V.P. Road, Charni Road, Bhatwadi, Prarthna Samaj, Mumbai 400004</p>
      </a>
      <a href="tel:+912247836669" class="contact-preview-card">
        <div class="contact-preview-icon">📞</div>
        <h3>Phone</h3>
        <p>022-47836669<br>022-23865845</p>
      </a>
      <a href="mailto:principalmvhs70@gmail.com" class="contact-preview-card">
        <div class="contact-preview-icon">✉️</div>
        <h3>Email</h3>
        <p>principalmvhs70@gmail.com</p>
      </a>
      <a href="contact.php" class="contact-preview-card">
        <div class="contact-preview-icon">🗺️</div>
        <h3>Directions</h3>
        <p>Nearest station: Charni Road (Western Line)</p>
      </a>
    </div>

    <div style="text-align:center;margin-top:24px;">
      <a href="contact.php" class="btn btn-secondary">View Full Contact Page →</a>
    </div>
  </div>
</section>

</main><!-- /#main-content -->

<!-- ===================================================================
     ADMISSION POPUP
     All field names, form action, and redirect behaviour UNCHANGED
==================================================================== -->
<div id="admissionModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="popupTitle">
  <div class="modal-box admission-layout">

    <button class="close-modal" onclick="closeModal()" aria-label="Close admission enquiry form" type="button">&times;</button>

    <!-- LEFT: FORM -->
    <div class="admission-form">
      <h2 id="popupTitle">Admission Enquiry</h2>
      <p style="font-size:13px;color:var(--text-secondary);margin-bottom:18px;">
        Fill in your details and we'll get in touch with you shortly.
      </p>

      <form action="save-enquiry.php" method="POST" id="admissionPopupForm" novalidate>

        <div class="form-group">
          <label for="popup_student">Student Name <span class="required">*</span></label>
          <input type="text" name="student" id="popup_student" placeholder="Full name of student" required autocomplete="name">
        </div>

        <div class="form-group">
          <label for="popup_parent">Parent / Guardian Name <span class="required">*</span></label>
          <input type="text" name="parent" id="popup_parent" placeholder="Parent or guardian name" required autocomplete="name">
        </div>

        <div class="form-group">
          <label for="popup_year">Expected Admission Year <span class="required">*</span></label>
          <select name="academic_year" id="popup_year" required>
            <option value="">Select Academic Year</option>
            <option value="<?= CURRENT_AY ?>"><?= CURRENT_AY ?></option>
          </select>
        </div>

        <div class="form-group">
          <label for="popup_class">Grade Seeking Admission <span class="required">*</span></label>
          <select name="class" id="popup_class" required>
            <option value="">Select Grade</option>
            <option value="Nursery">Nursery</option>
            <option value="Jr. KG">Jr. KG</option>
            <option value="Sr. KG">Sr. KG</option>
            <option value="Grade 1">Grade 1</option>
            <option value="Grade 2">Grade 2</option>
            <option value="Grade 3">Grade 3</option>
            <option value="Grade 4">Grade 4</option>
            <option value="Grade 5">Grade 5</option>
            <option value="Grade 6">Grade 6</option>
            <option value="Grade 7">Grade 7</option>
            <option value="Grade 8">Grade 8</option>
            <option value="Grade 9">Grade 9</option>
            <option value="Grade 10">Grade 10</option>
          </select>
        </div>

        <div class="form-group">
          <label for="popup_phone">Phone Number <span class="required">*</span></label>
          <input type="tel" name="phone" id="popup_phone" placeholder="+91 XXXXX XXXXX" required autocomplete="tel" inputmode="tel">
        </div>

        <div class="form-group">
          <label for="popup_email">Email Address <span class="required">*</span></label>
          <input type="email" name="email" id="popup_email" placeholder="parent@example.com" required autocomplete="email">
        </div>

        <div class="form-group">
          <label for="popup_message">Message (Optional)</label>
          <textarea name="message" id="popup_message" rows="3" placeholder="Any specific query or note"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%;margin-top:6px;" id="popupSubmitBtn">
          Submit Enquiry
        </button>

      </form>
    </div><!-- /admission-form -->

    <!-- RIGHT: PAMPHLET -->
    <div class="admission-pamphlet">
      <img
        src="assets/PamphletImage.jpg"
        alt="M.V. High School admission pamphlet — English Medium and Hindi Medium"
        loading="lazy"
        width="380"
        height="520"
      >
    </div>

  </div>
</div><!-- /admissionModal -->

<!-- SEO internal links (hidden, for crawlers) -->
<div class="seo-hidden-content" aria-hidden="true">
  M.V. High School in Charni Road, Mumbai offers English Medium education from Nursery to 10th standard
  and Hindi Medium education for Secondary classes from 8th to 10th standard.
  <a href="about.php">About Us</a> |
  <a href="admissions.php">Admissions</a> |
  <a href="academics.php">Academics</a> |
  <a href="gallery.php">Campus Life</a> |
  <a href="contact.php">Contact Us</a>
</div>

<!-- SCRIPTS -->
<script src="footer.js" defer></script>

<script>
(function() {
  /* ---- POPUP: show only once per session ---- */
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('success')) {
    sessionStorage.setItem('admissionPopupShown', 'yes');
  }
  if (!sessionStorage.getItem('admissionPopupShown')) {
    const modal = document.getElementById('admissionModal');
    if (modal) {
      // Slight delay so page renders first
      setTimeout(() => { modal.style.display = 'flex'; }, 1200);
    }
  }

  /* ---- SLIDESHOW ---- */
  document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide-img');
    if (slides.length <= 1) return;
    let idx = 0;

    function showSlide() {
      slides.forEach((img, i) => {
        img.style.opacity = i === idx ? '1' : '0';
      });
      idx = (idx + 1) % slides.length;
    }

    showSlide();
    setInterval(showSlide, 4500);
  });

  /* ---- POPUP: close + prevent duplicate submit ---- */
  window.closeModal = function() {
    const modal = document.getElementById('admissionModal');
    if (modal) modal.style.display = 'none';
    sessionStorage.setItem('admissionPopupShown', 'yes');
  };

  /* Close on Escape */
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      const modal = document.getElementById('admissionModal');
      if (modal && modal.style.display === 'flex') closeModal();
    }
  });

  /* Close on overlay click */
  const modal = document.getElementById('admissionModal');
  if (modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) closeModal();
    });
  }

  /* Prevent duplicate form submission */
  const form = document.getElementById('admissionPopupForm');
  const submitBtn = document.getElementById('popupSubmitBtn');
  if (form && submitBtn) {
    form.addEventListener('submit', function() {
      submitBtn.disabled = true;
      submitBtn.textContent = 'Submitting...';
      submitBtn.classList.add('loading');
    });
  }

  /* Keyboard: news and gallery cards */
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && e.target.hasAttribute('onclick') && e.target.hasAttribute('role')) {
      e.target.click();
    }
  });
})();
</script>

</body>
</html>