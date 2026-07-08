<?php
include "db.php";
include "config.php";

$seoTitle    = "School Accomplishments | M.V. High School, Charni Road, Mumbai";
$seoDescription = "Explore M.V. High School's accomplishments in academics, sports, arts and community service.";
$seoCanonical = BASE_URL . "/accomplishments.php";

/* ---- DB — unchanged ---- */
$result = mysqli_query($conn, "SELECT * FROM accomplishments ORDER BY id DESC");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($seoTitle) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= htmlspecialchars($seoDescription) ?>">
  <link rel="canonical" href="<?= $seoCanonical ?>">
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="styles.css?v=6">
  <link rel="stylesheet" href="main.css?v=6">
</head>
<body>

<header></header>
<script src="load-header.js?v=6" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="Accomplishments hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Accomplishments</span>
    </nav>
    <h1>School Accomplishments</h1>
    <p class="lead">Celebrating achievements in academics, sports, arts and community service.</p>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);" aria-labelledby="acc-heading">
  <div class="container">

    <div class="section-header" style="margin-bottom:24px;">
      <div class="eyebrow">Achievements</div>
      <h2 id="acc-heading" style="color:var(--navy);">Our Accomplishments</h2>
    </div>

    <?php
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) $rows[] = $row;
    ?>

    <?php if(count($rows) > 0): ?>
    <div class="grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:22px;">
      <?php foreach($rows as $row): ?>
      <article
        class="card card-hover"
        style="border-left:4px solid var(--gold);cursor:pointer;"
        onclick="location.href='accomplishment-details.php?slug=<?= urlencode($row['slug']) ?>'"
        role="link"
        tabindex="0"
        aria-label="<?= htmlspecialchars($row['title']) ?>"
        onkeydown="if(event.key==='Enter') location.href='accomplishment-details.php?slug=<?= urlencode($row['slug']) ?>'"
      >
        <h3 style="font-size:1rem;font-weight:700;color:var(--navy);margin-bottom:8px;"><?= htmlspecialchars($row['title']) ?></h3>
        <p style="font-size:13px;color:var(--text-secondary);line-height:1.6;"><?= htmlspecialchars(mb_substr($row['description'] ?? '', 0, 90)) ?>...</p>
        <span style="font-size:12px;font-weight:700;color:var(--navy-mid);margin-top:10px;display:inline-block;">Read More →</span>
      </article>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state"><p>Accomplishments are being updated. Check back soon.</p></div>
    <?php endif; ?>

  </div>
</section>

</main>

<script src="footer.js?v=6" defer></script>
</body>
</html>
