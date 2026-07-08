<?php
include "db.php";
include "config.php";

$seoTitle       = "Academics | M.V. High School, Charni Road, Mumbai";
$seoDescription = "Explore the academic curriculum at M.V. High School — Pre-Primary, Primary, Secondary and Higher Secondary for English and Hindi medium students.";
$seoKeywords    = "M.V. High School academics, school curriculum Mumbai, English medium curriculum, Hindi medium curriculum, books list Mumbai school";
$seoCanonical   = BASE_URL . "/academics.php";
$seoImage       = BASE_URL . "/assets/PamphletImage.jpg";
$seoType        = "website";

/* ---- DB — unchanged ---- */
$levels = false;
if (isset($conn) && $conn) {
    $levels = mysqli_query($conn, "SELECT * FROM academic_levels ORDER BY id ASC");
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
  <link rel="stylesheet" href="academics.css">

  <style>
  .levels-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 22px;
    margin-top: 24px;
  }

  .level-icon { font-size: 2.4rem; margin-bottom: 14px; display: block; }

  #grade-list { margin-top: 10px; }
  #book-details { display: none; margin-top: 20px; }

  .back-strip {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding: 14px 18px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    box-shadow: var(--shadow-sm);
  }

  .back-strip h2 { font-size: 1.1rem; color: var(--navy); margin: 0; }
  .back-strip h2::after { display: none; }
  </style>
</head>
<body>

<header></header>
<script src="load-header.js?v=3" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="Academics page hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Academics</span>
    </nav>
    <h1>Academics at M.V. High School</h1>
    <p class="lead">Structured learning from Pre-Primary through Secondary — English &amp; Hindi Medium.</p>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);">
  <div class="container">

    <div class="section-header">
      <div class="eyebrow">Our Programmes</div>
      <h2 style="color:var(--navy);">Academic Levels</h2>
      <p class="lead">Choose an academic level to explore grades and books.</p>
    </div>

    <div class="levels-grid" id="level-list">
      <?php
      $levelArr = [];
      if ($levels) {
        while($l = mysqli_fetch_assoc($levels)) {
          $levelArr[] = $l;
        }
      }

      $icons = ['🌱','📖','🔬','🎓','📐'];
      foreach($levelArr as $idx => $l):
        $icon = $icons[$idx] ?? '📚';
      ?>
      <button
        class="ac-card feature-card"
        onclick="showGrades(<?= (int)$l['id'] ?>, '<?= htmlspecialchars(addslashes($l['level_name'])) ?>')"
        aria-label="View grades for <?= htmlspecialchars($l['level_name']) ?>"
        type="button"
      >
        <span class="level-icon"><?= $icon ?></span>
        <div class="icon" style="display:none;"></div>
        <h3><?= htmlspecialchars($l['level_name']) ?></h3>
        <?php if(!empty($l['description'])): ?>
          <p><?= htmlspecialchars($l['description']) ?></p>
        <?php endif; ?>
      </button>
      <?php endforeach; ?>

      <?php if(count($levelArr) === 0): ?>
      <div class="empty-state" style="grid-column:1/-1;">
        <p>Academic levels are being updated. Please check back soon.</p>
      </div>
      <?php endif; ?>
    </div>

    <!-- Grades list (filled by academics.js) -->
    <div id="grade-list" style="display:none;"></div>

    <!-- Book details (filled by academics.js) -->
    <div id="book-details"></div>

  </div>
</section>

<!-- MEDIUM INFO -->
<section class="section-sm" style="background:var(--blue-bg);">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
      <div class="card card-hover" style="border-top:3px solid var(--gold);">
        <h3 style="margin-bottom:10px;font-size:1rem;color:var(--navy);">🇬🇧 English Medium</h3>
        <p style="font-size:14px;color:var(--text-secondary);">Available from Nursery through Grade 10. Strong English-language foundation with modern curriculum.</p>
      </div>
      <div class="card card-hover" style="border-top:3px solid var(--navy-mid);">
        <h3 style="margin-bottom:10px;font-size:1rem;color:var(--navy);">🇮🇳 Hindi Medium</h3>
        <p style="font-size:14px;color:var(--text-secondary);">Available for Secondary classes — Grade 8 through Grade 10. Quality education delivered in Hindi.</p>
      </div>
    </div>
  </div>
</section>

</main>

<script src="academics.js"></script>
<script src="footer.js" defer></script>
</body>
</html>