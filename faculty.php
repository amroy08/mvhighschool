<?php
include "db.php";
include "config.php";

$seoTitle       = "Faculty | M.V. High School, Charni Road, Mumbai";
$seoDescription = "Meet the experienced and qualified faculty of M.V. High School, Charni Road, Mumbai — our teaching and non-teaching staff.";
$seoKeywords    = "M.V. High School faculty, school teachers Mumbai, teaching staff Charni Road";
$seoCanonical   = BASE_URL . "/faculty.php";
$seoImage       = BASE_URL . "/assets/PamphletImage.jpg";
$seoType        = "website";

/* ---- DB — unchanged ---- */
$teaching    = mysqli_query($conn, "SELECT * FROM faculty WHERE type='Teaching' ORDER BY id ASC");
$nonteaching = mysqli_query($conn, "SELECT * FROM faculty WHERE type='Non-Teaching' ORDER BY id ASC");

$teaching_arr    = [];
$nonteaching_arr = [];
while($r = mysqli_fetch_assoc($teaching))    $teaching_arr[]    = $r;
while($r = mysqli_fetch_assoc($nonteaching)) $nonteaching_arr[] = $r;
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
  .faculty-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 22px;
    margin-top: 16px;
  }

  .faculty-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px 16px;
    text-align: center;
    box-shadow: var(--shadow);
    transition: var(--transition);
  }

  .faculty-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-md);
    border-color: var(--gold);
  }

  .faculty-photo {
    width: 90px;
    height: 100px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    margin: 0 auto 14px;
    border: 2px solid var(--border);
    display: block;
    background: var(--blue-bg);
  }

  .faculty-photo-placeholder {
    width: 90px;
    height: 100px;
    border-radius: var(--radius-sm);
    background: linear-gradient(135deg, var(--blue-bg), var(--border-light));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin: 0 auto 14px;
  }

  .faculty-card h3 {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 4px;
    text-transform: capitalize;
  }

  .faculty-card .desig {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--navy-mid);
    margin-bottom: 6px;
  }

  .faculty-card .meta {
    font-size: 12px;
    color: var(--text-secondary);
    line-height: 1.5;
  }

  .faculty-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 22px;
    height: 22px;
    background: var(--gold-soft-md);
    border: 1px solid var(--gold-soft-md);
    border-radius: var(--radius-pill);
    font-size: 11px;
    font-weight: 800;
    color: var(--gold-dark);
    padding: 0 6px;
    margin-left: 6px;
  }
  </style>
</head>
<body>

<header></header>
<script src="load-header.js?v=3" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="Faculty page hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Faculty</span>
    </nav>
    <h1>Our Faculty</h1>
    <p class="lead">Dedicated educators committed to every student&rsquo;s academic and personal growth.</p>
  </div>
</section>

<main id="main-content">

<!-- TAB SWITCHER -->
<section class="section" style="background:var(--surface);">
  <div class="container">

    <div class="tabs-wrap" role="tablist" aria-label="Faculty categories" style="justify-content:flex-start;">
      <button
        class="tab-btn active"
        id="tab-teaching"
        onclick="switchTab('teaching')"
        role="tab"
        aria-selected="true"
        aria-controls="panel-teaching"
        type="button"
      >
        Teaching Staff <span class="faculty-count"><?= count($teaching_arr) ?></span>
      </button>
      <button
        class="tab-btn"
        id="tab-nonteaching"
        onclick="switchTab('nonteaching')"
        role="tab"
        aria-selected="false"
        aria-controls="panel-nonteaching"
        type="button"
      >
        Non-Teaching Staff <span class="faculty-count"><?= count($nonteaching_arr) ?></span>
      </button>
    </div>

    <!-- Teaching Panel -->
    <div id="panel-teaching" class="panel active" role="tabpanel" aria-labelledby="tab-teaching">
      <?php if(count($teaching_arr) > 0): ?>
      <div class="faculty-grid">
        <?php foreach($teaching_arr as $f): ?>
        <div class="faculty-card">
          <?php if(!empty($f['photo'])): ?>
            <img
              src="assets/<?= htmlspecialchars($f['photo']) ?>"
              class="faculty-photo"
              alt="<?= htmlspecialchars($f['name']) ?> — <?= htmlspecialchars($f['designation'] ?? 'Teacher') ?>"
              loading="lazy"
              width="90"
              height="100"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
            >
            <div class="faculty-photo-placeholder" style="display:none;">👤</div>
          <?php else: ?>
            <div class="faculty-photo-placeholder">👤</div>
          <?php endif; ?>
          <h3><?= htmlspecialchars($f['name']) ?></h3>
          <?php if(!empty($f['designation'])): ?>
            <p class="desig"><?= htmlspecialchars($f['designation']) ?></p>
          <?php endif; ?>
          <div class="meta">
            <?php if(!empty($f['qualification'])): ?>
              <div><?= htmlspecialchars($f['qualification']) ?></div>
            <?php endif; ?>
            <?php if(!empty($f['experience'])): ?>
              <div><?= htmlspecialchars($f['experience']) ?> exp.</div>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php else: ?>
      <div class="empty-state" style="margin-top:20px;"><p>Teaching staff information is being updated.</p></div>
      <?php endif; ?>
    </div>

    <!-- Non-Teaching Panel -->
    <div id="panel-nonteaching" class="panel" role="tabpanel" aria-labelledby="tab-nonteaching">
      <?php if(count($nonteaching_arr) > 0): ?>
      <div class="faculty-grid">
        <?php foreach($nonteaching_arr as $f): ?>
        <div class="faculty-card">
          <?php if(!empty($f['photo'])): ?>
            <img
              src="assets/<?= htmlspecialchars($f['photo']) ?>"
              class="faculty-photo"
              alt="<?= htmlspecialchars($f['name']) ?> — <?= htmlspecialchars($f['designation'] ?? 'Staff') ?>"
              loading="lazy"
              width="90"
              height="100"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
            >
            <div class="faculty-photo-placeholder" style="display:none;">👤</div>
          <?php else: ?>
            <div class="faculty-photo-placeholder">👤</div>
          <?php endif; ?>
          <h3><?= htmlspecialchars($f['name']) ?></h3>
          <?php if(!empty($f['designation'])): ?>
            <p class="desig"><?= htmlspecialchars($f['designation']) ?></p>
          <?php endif; ?>
          <div class="meta">
            <?php if(!empty($f['qualification'])): ?>
              <div><?= htmlspecialchars($f['qualification']) ?></div>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php else: ?>
      <div class="empty-state" style="margin-top:20px;"><p>Non-teaching staff information is being updated.</p></div>
      <?php endif; ?>
    </div>

  </div>
</section>

</main>

<script src="footer.js" defer></script>
<script>
function switchTab(which) {
  ['teaching','nonteaching'].forEach(function(t) {
    var btn   = document.getElementById('tab-' + t);
    var panel = document.getElementById('panel-' + t);
    var isActive = t === which;
    btn.classList.toggle('active', isActive);
    btn.setAttribute('aria-selected', String(isActive));
    panel.classList.toggle('active', isActive);
  });
}
</script>
</body>
</html>
