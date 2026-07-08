<?php
include "db.php";
include "config.php";

$seoTitle       = "News & Events | M.V. High School, Charni Road, Mumbai";
$seoDescription = "Latest news, events, circulars, and announcements from M.V. High School, Charni Road, Mumbai.";
$seoKeywords    = "M.V. High School news, school events Mumbai, school circulars, school announcements Charni Road";
$seoCanonical   = BASE_URL . "/news-events.php";
$seoImage       = BASE_URL . "/assets/PamphletImage.jpg";
$seoType        = "website";

/* ---- DB — unchanged ---- */
$result = mysqli_query($conn, "SELECT * FROM news_events WHERE status='Published' ORDER BY event_date DESC, id DESC");
$note   = "Due to unavoidable circumstances, there may be changes in the scheduled dates. Parents are kindly requested to cooperate with the school.";
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
  <link rel="stylesheet" href="styles.css?v=6">
  <link rel="stylesheet" href="main.css?v=6">

  <style>
  .news-events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
    gap: 22px;
    margin-top: 20px;
  }

  .news-event-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 22px;
    box-shadow: var(--shadow);
    transition: var(--transition);
    display: flex;
    flex-direction: column;
    gap: 10px;
    cursor: pointer;
  }

  .news-event-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
    border-color: var(--gold);
  }

  .ne-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    flex-wrap: wrap;
  }

  .ne-date {
    font-size: 12px;
    font-weight: 600;
    color: var(--muted);
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .ne-title {
    font-family: var(--font-heading);
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.4;
  }

  .ne-note {
    font-size: 12px;
    color: var(--text-secondary);
    background: var(--blue-bg);
    border: 1px solid var(--blue-bg-dark);
    border-radius: var(--radius-xs);
    padding: 6px 10px;
    line-height: 1.5;
  }

  .ne-action {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 13px;
    font-weight: 700;
    color: var(--navy-mid);
    text-decoration: none;
    transition: color var(--transition-fast);
    margin-top: auto;
  }

  .ne-action:hover { color: var(--gold-dark); }
  </style>
</head>
<body>

<header></header>
<script src="load-header.js?v=6" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="News and Events hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">News &amp; Events</span>
    </nav>
    <h1>News &amp; Events</h1>
    <p class="lead">Latest school announcements, circulars, events and notices.</p>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);" aria-labelledby="news-heading">
  <div class="container">
    <div class="section-header" style="margin-bottom:20px;">
      <div class="eyebrow">School Updates</div>
      <h2 id="news-heading" style="color:var(--navy);">Published Announcements</h2>
    </div>

    <!-- Global note -->
    <div class="alert alert-note" role="note" style="margin-bottom:22px;">
      <strong>Note:</strong> <?= htmlspecialchars($note) ?>
    </div>

    <?php
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) $rows[] = $row;
    ?>

    <?php if(count($rows) > 0): ?>
    <div class="news-events-grid">
      <?php foreach($rows as $row):
        $dateText = '';
        if (!empty($row['event_date'])) {
          $ts = strtotime($row['event_date']);
          if ($ts) $dateText = date('d M Y', $ts);
        }
      ?>
      <div
        class="news-event-card"
        onclick="location.href='news-details.php?id=<?= (int)$row['id'] ?>'"
        role="link"
        tabindex="0"
        aria-label="<?= htmlspecialchars($row['title']) ?>"
        onkeydown="if(event.key==='Enter') location.href='news-details.php?id=<?= (int)$row['id'] ?>'"
      >
        <div class="ne-meta">
          <span class="badge"><?= htmlspecialchars($row['status']) ?></span>
          <?php if($dateText): ?>
            <span class="ne-date">📅 <?= htmlspecialchars($dateText) ?></span>
          <?php endif; ?>
        </div>

        <h2 class="ne-title"><?= htmlspecialchars($row['title']) ?></h2>

        <a href="news-details.php?id=<?= (int)$row['id'] ?>" class="ne-action" tabindex="-1">
          View Circular / PDF →
        </a>
      </div>
      <?php endforeach; ?>
    </div>

    <?php else: ?>
    <div class="empty-state">
      <p>No published announcements at the moment. Check back soon.</p>
    </div>
    <?php endif; ?>

  </div>
</section>

</main>

<script src="footer.js?v=6" defer></script>
</body>
</html>
