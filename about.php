<?php
include "db.php";
include "config.php";

$seoTitle       = "About M.V. High School | Charni Road, Mumbai";
$seoDescription = "Learn about M.V. High School in Charni Road, Mumbai — our principal's message, trustee's message, leadership team, mission, vision, values, and school journey.";
$seoKeywords    = "About M.V. High School, school in Charni Road, school in Mumbai, English medium school Mumbai, Hindi medium school Mumbai";
$seoCanonical   = BASE_URL . "/about.php";
$seoImage       = BASE_URL . "/assets/PamphletImage.jpg";
$seoType        = "website";

/* ---- DB QUERIES — unchanged ---- */
$principal   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_principal ORDER BY id DESC LIMIT 1"));
$trustee     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_trustee ORDER BY id DESC LIMIT 1"));
$teamResult  = mysqli_query($conn, "SELECT * FROM about_leadership_team ORDER BY id ASC");
$journeyResult = mysqli_query($conn, "SELECT * FROM about_journey ORDER BY year ASC");
$mission     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_mvv WHERE type='mission'"));
$vision      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_mvv WHERE type='vision'"));
$values_row  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_mvv WHERE type='values'"));
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
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="styles.css">

  <style>
  /* ============ ABOUT PAGE SPECIFIC ============ */

  .about-nav {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    padding: 0;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: var(--shadow-sm);
  }

  .about-nav-inner {
    display: flex;
    gap: 0;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
  }

  .about-nav-inner::-webkit-scrollbar { display: none; }

  .about-nav-link {
    display: inline-flex;
    align-items: center;
    padding: 14px 20px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-secondary);
    text-decoration: none;
    white-space: nowrap;
    border-bottom: 2px solid transparent;
    transition: all var(--transition-fast);
  }

  .about-nav-link:hover,
  .about-nav-link.active {
    color: var(--navy);
    border-bottom-color: var(--gold);
  }

  /* Profile cards */
  .profile-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
    align-items: start;
  }

  .profile-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    height: 100%;
  }

  .profile-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
  }

  .profile-photo-band {
    background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 100%);
    padding: 28px 24px;
    display: flex;
    align-items: center;
    gap: 20px;
  }

  .profile-photo {
    width: 100px;
    height: 115px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    border: 2px solid rgba(229,164,38,0.4);
    flex-shrink: 0;
  }

  .profile-photo-placeholder {
    width: 100px;
    height: 115px;
    border-radius: var(--radius-sm);
    background: rgba(255,255,255,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    flex-shrink: 0;
  }

  .profile-identity-name {
    font-family: var(--font-heading);
    font-size: 1.1rem;
    font-weight: 700;
    color: #fff;
    line-height: 1.3;
    margin-bottom: 4px;
  }

  .profile-identity-desig {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--gold-light);
  }

  .profile-body {
    padding: 24px;
  }

  .profile-body p {
    font-size: 14px;
    line-height: 1.8;
    color: var(--text-secondary);
  }

  /* MVV Cards */
  .mvv-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 22px;
    margin-top: 12px;
  }

  .mvv-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 28px 24px;
    box-shadow: var(--shadow);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
  }

  .mvv-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
  }

  .mvv-card.mission::before { background: var(--gold); }
  .mvv-card.vision::before  { background: var(--navy-mid); }
  .mvv-card.values::before  { background: var(--success); }

  .mvv-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }

  .mvv-card .mvv-icon { font-size: 2rem; margin-bottom: 12px; }
  .mvv-card h3 { font-size: 1.1rem; margin-bottom: 12px; color: var(--navy); }
  .mvv-card p  { font-size: 14px; line-height: 1.8; color: var(--text-secondary); }

  /* Team grid */
  .team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 22px;
    margin-top: 12px;
  }

  .team-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px 18px;
    text-align: center;
    box-shadow: var(--shadow);
    transition: var(--transition);
  }

  .team-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); border-color: var(--gold); }

  .team-photo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 14px;
    border: 3px solid var(--gold-soft-md);
    background: var(--blue-bg);
  }

  .team-photo-placeholder {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: var(--blue-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 14px;
  }

  .team-card h3 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 4px;
  }

  .team-card .designation {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 8px;
  }

  .team-card p { font-size: 13px; color: var(--text-secondary); line-height: 1.6; }

  /* Timeline */
  .timeline-section {
    background: var(--ivory);
  }

  .timeline {
    position: relative;
    padding: 20px 0;
    max-width: 900px;
    margin: 24px auto 0;
  }

  .timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, var(--gold) 0%, var(--navy-mid) 100%);
    transform: translateX(-50%);
    border-radius: 2px;
  }

  .timeline-item {
    width: 46%;
    padding: 20px 24px;
    position: relative;
    box-sizing: border-box;
  }

  .timeline-item:nth-child(odd) {
    left: 0;
    text-align: right;
    padding-right: 36px;
  }

  .timeline-item:nth-child(even) {
    left: 54%;
    text-align: left;
    padding-left: 36px;
  }

  /* Dot */
  .timeline-item::before {
    content: '';
    position: absolute;
    width: 14px;
    height: 14px;
    background: var(--gold);
    border: 3px solid var(--surface);
    border-radius: 50%;
    box-shadow: 0 0 0 3px var(--gold-soft-md);
    top: 28px;
  }

  .timeline-item:nth-child(odd)::before  { right: -7px; }
  .timeline-item:nth-child(even)::before { left: -7px; }

  .timeline-year {
    font-family: var(--font-heading);
    font-size: 1.35rem;
    font-weight: 800;
    color: var(--navy-mid);
    margin-bottom: 6px;
  }

  .timeline-content {
    background: var(--surface);
    padding: 16px 18px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
    transition: var(--transition);
  }

  .timeline-content:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }

  .timeline-content h3 {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 6px;
  }

  .timeline-content p {
    font-size: 13px;
    color: var(--text-secondary);
    line-height: 1.6;
  }

  .timeline-item img {
    max-width: 220px;
    border-radius: var(--radius-sm);
    margin-top: 10px;
    box-shadow: var(--shadow);
    display: block;
  }

  .timeline-item:nth-child(odd) img { margin-left: auto; }

  @media (max-width: 768px) {
    .profile-grid { grid-template-columns: 1fr; }
    .profile-photo-band { flex-direction: column; text-align: center; }

    .timeline::before { left: 20px; }
    .timeline-item { width: 100%; left: 0 !important; text-align: left !important; padding: 12px 16px 12px 48px !important; }
    .timeline-item::before { left: 13px !important; right: auto !important; }
    .timeline-item img { margin-left: 0 !important; }
  }
  </style>
</head>
<body>

<header></header>
<script src="load-header.js?v=3" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="About page hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">About Us</span>
    </nav>
    <h1>About M.V. High School</h1>
    <p class="lead">
      Our story, our people and our commitment to every student's growth.
    </p>
  </div>
</section>

<!-- STICKY SECTION NAV -->
<nav class="about-nav" aria-label="About page sections">
  <div class="container">
    <div class="about-nav-inner">
      <a href="#principal"  class="about-nav-link">Principal's Message</a>
      <a href="#trustee"    class="about-nav-link">Trustee's Message</a>
      <a href="#team"       class="about-nav-link">Leadership Team</a>
      <a href="#mvv"        class="about-nav-link">Mission &amp; Vision</a>
      <a href="#journey"    class="about-nav-link">School Journey</a>
    </div>
  </div>
</nav>

<main id="main-content">

<!-- PRINCIPAL + TRUSTEE -->
<?php if ($principal || $trustee): ?>
<section class="section" style="background:var(--surface);">
  <div class="container">
    <div class="profile-grid">

      <?php if ($principal): ?>
      <div id="principal">
        <div class="eyebrow">Our Principal</div>
        <h2 style="color:var(--navy);margin-bottom:20px;">Principal&rsquo;s Message</h2>
        <div class="profile-card">
          <div class="profile-photo-band">
            <?php if(!empty($principal['image'])): ?>
              <img
                src="assets/<?= htmlspecialchars($principal['image']) ?>"
                class="profile-photo"
                alt="<?= htmlspecialchars($principal['name']) ?> — Principal"
                loading="lazy"
                width="100"
                height="115"
              >
            <?php else: ?>
              <div class="profile-photo-placeholder">👤</div>
            <?php endif; ?>
            <div>
              <div class="profile-identity-name"><?= htmlspecialchars($principal['name']) ?></div>
              <?php if(!empty($principal['designation'])): ?>
                <div class="profile-identity-desig"><?= htmlspecialchars($principal['designation']) ?></div>
              <?php endif; ?>
            </div>
          </div>
          <div class="profile-body">
            <p><?= nl2br(htmlspecialchars($principal['message'])) ?></p>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <?php if ($trustee): ?>
      <div id="trustee">
        <div class="eyebrow">Our Trustee</div>
        <h2 style="color:var(--navy);margin-bottom:20px;">Trustee&rsquo;s Message</h2>
        <div class="profile-card">
          <div class="profile-photo-band">
            <?php if(!empty($trustee['image'])): ?>
              <img
                src="assets/<?= htmlspecialchars($trustee['image']) ?>"
                class="profile-photo"
                alt="<?= htmlspecialchars($trustee['name']) ?> — Trustee"
                loading="lazy"
                width="100"
                height="115"
              >
            <?php else: ?>
              <div class="profile-photo-placeholder">👤</div>
            <?php endif; ?>
            <div>
              <div class="profile-identity-name"><?= htmlspecialchars($trustee['name']) ?></div>
              <?php if(!empty($trustee['designation'])): ?>
                <div class="profile-identity-desig"><?= htmlspecialchars($trustee['designation']) ?></div>
              <?php endif; ?>
            </div>
          </div>
          <div class="profile-body">
            <p><?= nl2br(htmlspecialchars($trustee['message'])) ?></p>
          </div>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>
<?php endif; ?>

<!-- LEADERSHIP TEAM -->
<section class="section" style="background:var(--blue-bg);" id="team" aria-labelledby="team-heading">
  <div class="container">
    <div class="section-header center">
      <div class="eyebrow">Our People</div>
      <h2 id="team-heading" class="no-line" style="color:var(--navy);">Leadership Team</h2>
    </div>
    <?php
    $team_rows = [];
    while($t = mysqli_fetch_assoc($teamResult)) $team_rows[] = $t;
    ?>
    <?php if(count($team_rows) > 0): ?>
    <div class="team-grid">
      <?php foreach($team_rows as $t): ?>
      <div class="team-card">
        <?php if(!empty($t['image'])): ?>
          <img
            src="assets/<?= htmlspecialchars($t['image']) ?>"
            class="team-photo"
            alt="<?= htmlspecialchars($t['name']) ?>"
            loading="lazy"
            width="100"
            height="100"
            onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
          >
          <div class="team-photo-placeholder" style="display:none;">👤</div>
        <?php else: ?>
          <div class="team-photo-placeholder">👤</div>
        <?php endif; ?>
        <h3><?= htmlspecialchars($t['name']) ?></h3>
        <?php if(!empty($t['designation'])): ?>
          <p class="designation"><?= htmlspecialchars($t['designation']) ?></p>
        <?php endif; ?>
        <?php if(!empty($t['message'])): ?>
          <p><?= nl2br(htmlspecialchars($t['message'])) ?></p>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state"><p>Leadership team information coming soon.</p></div>
    <?php endif; ?>
  </div>
</section>

<!-- MISSION / VISION / VALUES -->
<section class="section" style="background:var(--surface);" id="mvv" aria-labelledby="mvv-heading">
  <div class="container">
    <div class="section-header center">
      <div class="eyebrow">Our Foundation</div>
      <h2 id="mvv-heading" class="no-line" style="color:var(--navy);">Mission, Vision &amp; Values</h2>
    </div>
    <div class="mvv-grid">
      <?php if($mission && !empty($mission['content'])): ?>
      <div class="mvv-card mission">
        <div class="mvv-icon">🎯</div>
        <h3>Our Mission</h3>
        <p><?= nl2br(htmlspecialchars($mission['content'])) ?></p>
      </div>
      <?php endif; ?>

      <?php if($vision && !empty($vision['content'])): ?>
      <div class="mvv-card vision">
        <div class="mvv-icon">🔭</div>
        <h3>Our Vision</h3>
        <p><?= nl2br(htmlspecialchars($vision['content'])) ?></p>
      </div>
      <?php endif; ?>

      <?php if($values_row && !empty($values_row['content'])): ?>
      <div class="mvv-card values">
        <div class="mvv-icon">💎</div>
        <h3>Our Values</h3>
        <p><?= nl2br(htmlspecialchars($values_row['content'])) ?></p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- SCHOOL JOURNEY TIMELINE -->
<section class="section timeline-section" id="journey" aria-labelledby="journey-heading">
  <div class="container">
    <div class="section-header center">
      <div class="eyebrow">Our History</div>
      <h2 id="journey-heading" class="no-line" style="color:var(--navy);">School Journey</h2>
      <p class="lead" style="margin:10px auto 0;">Key milestones that shaped M.V. High School.</p>
    </div>

    <?php
    $journey_rows = [];
    while($j = mysqli_fetch_assoc($journeyResult)) $journey_rows[] = $j;
    ?>

    <?php if(count($journey_rows) > 0): ?>
    <div class="timeline" aria-label="School journey timeline">
      <?php foreach($journey_rows as $j): ?>
      <div class="timeline-item">
        <div class="timeline-year"><?= htmlspecialchars($j['year']) ?></div>
        <div class="timeline-content">
          <h3><?= htmlspecialchars($j['title']) ?></h3>
          <p><?= nl2br(htmlspecialchars($j['description'])) ?></p>
          <?php if(!empty($j['image'])): ?>
            <img
              src="assets/<?= htmlspecialchars($j['image']) ?>"
              alt="M.V. High School — <?= htmlspecialchars($j['title']) ?>"
              loading="lazy"
              width="220"
              height="140"
            >
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state" style="max-width:500px;margin:24px auto 0;"><p>School journey information coming soon.</p></div>
    <?php endif; ?>
  </div>
</section>

</main>

<script src="footer.js" defer></script>
</body>
</html>