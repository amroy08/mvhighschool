<?php
include "db.php";
include "config.php";

// Validate and cast ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { die("<h2>Alumni profile not found</h2>"); }

if (!isset($conn) || !$conn) {
    die("<h2>Database connection error</h2>");
}

// Use prepared statement
$stmt = mysqli_prepare($conn, "SELECT * FROM alumni WHERE id = ?");
if (!$stmt) {
    die("<h2>Alumni profile not found</h2>");
}
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data   = mysqli_fetch_assoc($result);

if (!$data) { die("<h2>Alumni profile not found</h2>"); }

$name    = htmlspecialchars($data['name']);
$seoTitle = $name . " | Alumni | M.V. High School";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= $seoTitle ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="styles.css?v=5">
  <link rel="stylesheet" href="main.css?v=5">
</head>
<body>

<header></header>
<script src="load-header.js?v=5?v=5" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="Alumni detail hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <a href="alumni.php">Alumni</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page"><?= $name ?></span>
    </nav>
    <h1><?= $name ?></h1>
    <?php if(!empty($data['passing_year'])): ?>
      <p class="lead" style="font-size:0.9rem;">Batch: <?= htmlspecialchars($data['passing_year']) ?></p>
    <?php endif; ?>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);">
  <div class="container">

    <a href="alumni.php" class="btn btn-ghost btn-sm" style="margin-bottom:20px;">← Back to Alumni</a>

    <div class="card" style="max-width:900px;margin:0 auto;padding:32px;">
      <div style="display:grid;grid-template-columns:auto 1fr;gap:28px;align-items:start;">

        <!-- Photo -->
        <div>
          <?php if(!empty($data['photo'])): ?>
            <img
              src="assets/<?= htmlspecialchars($data['photo']) ?>"
              alt="<?= $name ?>"
              style="width:180px;height:220px;object-fit:contain;border-radius:var(--radius);border:2px solid var(--border);background:var(--blue-bg);padding:6px;"
              loading="lazy"
              width="180"
              height="220"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
            >
            <div style="display:none;width:180px;height:220px;background:var(--blue-bg);align-items:center;justify-content:center;font-size:4rem;border-radius:var(--radius);">👤</div>
          <?php else: ?>
            <div style="display:flex;width:180px;height:220px;background:var(--blue-bg);align-items:center;justify-content:center;font-size:4rem;border-radius:var(--radius);">👤</div>
          <?php endif; ?>
        </div>

        <!-- Info -->
        <div>
          <h2 style="font-size:1.35rem;color:var(--navy);margin-bottom:14px;"><?= $name ?></h2>

          <?php if(!empty($data['passing_year'])): ?>
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;">
            <strong style="font-size:13px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.06em;">Batch:</strong>
            <span style="font-weight:700;color:var(--ink);"><?= htmlspecialchars($data['passing_year']) ?></span>
          </div>
          <?php endif; ?>

          <?php if(!empty($data['achievement'])): ?>
          <div style="margin-bottom:14px;">
            <strong style="font-size:13px;color:var(--text-secondary);text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:4px;">Achievement:</strong>
            <span style="font-size:15px;color:var(--text);line-height:1.7;"><?= htmlspecialchars($data['achievement']) ?></span>
          </div>
          <?php endif; ?>

          <?php if(!empty($data['message'])): ?>
          <div style="background:var(--blue-bg);border-left:3px solid var(--gold);border-radius:var(--radius-sm);padding:16px;margin-top:16px;">
            <p style="font-style:italic;color:var(--text-secondary);font-size:15px;line-height:1.75;">&ldquo;<?= htmlspecialchars($data['message']) ?>&rdquo;</p>
          </div>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
</section>

</main>

<script src="footer.js?v=5" defer></script>
</body>
</html>
