<?php
include "db.php";
include "config.php";

$seoTitle    = "Our Proud Alumni | M.V. High School, Charni Road, Mumbai";
$seoDescription = "Meet the proud alumni of M.V. High School, Charni Road, Mumbai — students who have gone on to achieve great things.";
$seoCanonical = BASE_URL . "/alumni.php";

/* ---- DB — unchanged ---- */
$alumni = mysqli_query($conn, "SELECT * FROM alumni ORDER BY id DESC");
$rows   = [];
while($r = mysqli_fetch_assoc($alumni)) $rows[] = $r;
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
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<header></header>
<script src="load-header.js?v=3" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="Alumni page hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Alumni</span>
    </nav>
    <h1>Our Proud Alumni</h1>
    <p class="lead">Celebrating M.V. High School graduates who have made their mark in the world.</p>
  </div>
</section>

<main id="main-content">

<section class="alumni-section container">
  <div style="padding:0;">

    <?php if(count($rows) > 0): ?>
    <div class="alumni-grid">
      <?php foreach($rows as $row): ?>
      <a href="alumni-details.php?id=<?= (int)$row['id'] ?>" class="alumni-card-link">
        <div class="alumni-card">
          <?php if(!empty($row['photo'])): ?>
            <img
              src="assets/<?= htmlspecialchars($row['photo']) ?>"
              class="alumni-photo"
              alt="<?= htmlspecialchars($row['name']) ?>"
              loading="lazy"
              width="280"
              height="280"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
            >
            <div style="display:none;width:100%;height:200px;background:var(--blue-bg);align-items:center;justify-content:center;font-size:3rem;border-radius:var(--radius-sm);margin-bottom:16px;">👤</div>
          <?php else: ?>
            <div style="display:flex;width:100%;height:200px;background:var(--blue-bg);align-items:center;justify-content:center;font-size:3rem;border-radius:var(--radius-sm);margin-bottom:16px;">👤</div>
          <?php endif; ?>

          <h3><?= htmlspecialchars($row['name']) ?></h3>

          <?php if(!empty($row['passing_year'])): ?>
            <p class="year">Batch: <?= htmlspecialchars($row['passing_year']) ?></p>
          <?php endif; ?>

          <?php if(!empty($row['achievement'])): ?>
            <p class="achievement"><?= htmlspecialchars($row['achievement']) ?></p>
          <?php endif; ?>

          <?php if(!empty($row['message'])): ?>
            <p class="message">&ldquo;<?= htmlspecialchars(mb_substr($row['message'], 0, 120)) ?><?= mb_strlen($row['message']) > 120 ? '...' : '' ?>&rdquo;</p>
          <?php endif; ?>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state" style="margin:40px auto;"><p>Alumni profiles are being added. Check back soon.</p></div>
    <?php endif; ?>

  </div>
</section>

</main>

<script src="footer.js" defer></script>
</body>
</html>
