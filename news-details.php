<?php
include "db.php";
include "config.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
  die("<h2>News not found</h2>");
}

if (!isset($conn) || !$conn) {
  die("<h2>Database connection error</h2>");
}

$res  = mysqli_query($conn, "SELECT * FROM news_events WHERE id=$id AND status='Published' LIMIT 1");
if (!$res) {
  die("<h2>News not found</h2>");
}
$news = mysqli_fetch_assoc($res);

if (!$news) {
  die("<h2>News not found</h2>");
}

$note     = "Due to unavoidable circumstances, there may be changes in the scheduled dates. Parents are kindly requested to cooperate with the school.";
$dateText = '';
if (!empty($news['event_date'])) {
  $ts = strtotime($news['event_date']);
  if ($ts) $dateText = date("d M Y", $ts);
}

// PDF path — unchanged
$pdf    = isset($news['pdf_path']) ? ltrim($news['pdf_path'], '/') : '';
$pdfUrl = '/' . str_replace('%2F','/', rawurlencode($pdf));

$seoTitle    = htmlspecialchars($news['title']) . " | M.V. High School";
$seoCanonical = BASE_URL . "/news-details.php?id=$id";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= $seoTitle ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= htmlspecialchars($news['title']) ?> — M.V. High School, Charni Road, Mumbai.">
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
<section class="page-hero" aria-label="News detail hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <a href="news-events.php">News &amp; Events</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Details</span>
    </nav>
    <h1><?= htmlspecialchars($news['title']) ?></h1>
    <?php if($dateText): ?>
      <p class="lead" style="font-size:0.9rem;">📅 <?= htmlspecialchars($dateText) ?></p>
    <?php endif; ?>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);">
  <div class="container">

    <a href="news-events.php" class="btn btn-ghost btn-sm" style="margin-bottom:20px;">← Back to News &amp; Events</a>

    <div class="card" style="padding:28px;">

      <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:18px;">
        <span class="badge"><?= htmlspecialchars($news['status']) ?></span>
        <?php if($dateText): ?><span style="font-size:13px;color:var(--muted);font-weight:600;">📅 <?= htmlspecialchars($dateText) ?></span><?php endif; ?>
      </div>

      <div class="alert alert-note" role="note" style="margin-bottom:18px;">
        <strong>Note:</strong> <?= htmlspecialchars($note) ?>
      </div>

      <?php if(!empty($pdf)): ?>
      <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:18px;">
        <a class="btn btn-primary btn-sm" href="<?= htmlspecialchars($pdfUrl) ?>" target="_blank" rel="noopener noreferrer">📄 Open PDF</a>
        <a class="btn btn-ghost btn-sm" href="<?= htmlspecialchars($pdfUrl) ?>" download>⬇️ Download PDF</a>
      </div>

      <div style="border-radius:var(--radius);overflow:hidden;border:1px solid var(--border);height:80vh;background:var(--surface);">
        <iframe
          src="<?= htmlspecialchars($pdfUrl) ?>"
          style="width:100%;height:100%;border:0;"
          title="<?= htmlspecialchars($news['title']) ?>"
          aria-label="<?= htmlspecialchars($news['title']) ?> PDF document"
        ></iframe>
      </div>
      <?php else: ?>
      <div class="empty-state">
        <p>No PDF attached to this announcement.</p>
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>

</main>

<script src="footer.js?v=6" defer></script>
</body>
</html>
