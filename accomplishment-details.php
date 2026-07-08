<?php
include "db.php";
include "config.php";

// SQL injection fix: use prepared statement — preserving all data logic
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
if (empty($slug)) { die("<h2>Accomplishment not found</h2>"); }

if (!isset($conn) || !$conn) {
    die("<h2>Database connection error</h2>");
}

$stmt = mysqli_prepare($conn, "SELECT * FROM accomplishments WHERE slug = ?");
if (!$stmt) {
    die("<h2>Accomplishment not found</h2>");
}
mysqli_stmt_bind_param($stmt, "s", $slug);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$acc    = mysqli_fetch_assoc($result);

if (!$acc) { die("<h2>Accomplishment not found</h2>"); }

$seoTitle    = htmlspecialchars($acc['title']) . " | M.V. High School";
$seoCanonical = BASE_URL . "/accomplishment-details.php?slug=" . urlencode($slug);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= $seoTitle ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= htmlspecialchars(mb_substr($acc['description'] ?? '', 0, 155)) ?>">
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
<section class="page-hero" aria-label="Accomplishment detail hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <a href="accomplishments.php">Accomplishments</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Detail</span>
    </nav>
    <h1><?= htmlspecialchars($acc['title']) ?></h1>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);">
  <div class="container">

    <a href="accomplishments.php" class="btn btn-ghost btn-sm" style="margin-bottom:20px;">← Back to Accomplishments</a>

    <div class="card" style="max-width:850px;margin:0 auto;padding:32px;">

      <?php if(!empty($acc['image'])): ?>
        <img
          src="<?= htmlspecialchars($acc['image']) ?>"
          alt="<?= htmlspecialchars($acc['title']) ?>"
          style="width:100%;max-width:700px;border-radius:var(--radius);margin-bottom:24px;box-shadow:var(--shadow);"
          loading="lazy"
          width="700"
          height="400"
        >
      <?php endif; ?>

      <div style="font-size:17px;line-height:1.8;color:var(--text-secondary);">
        <?= nl2br(htmlspecialchars($acc['description'])) ?>
      </div>

      <div style="margin-top:24px;">
        <a href="accomplishments.php" class="btn btn-secondary btn-sm">← Back to All Accomplishments</a>
      </div>

    </div>

  </div>
</section>

</main>

<script src="footer.js?v=6" defer></script>
</body>
</html>
