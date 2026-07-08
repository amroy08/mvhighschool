<?php
include "db.php";
include "config.php";

$seoTitle       = "Gallery | M.V. High School, Charni Road, Mumbai";
$seoDescription = "Browse M.V. High School's campus gallery — photo albums of school events, sports, cultural programmes and campus activities.";
$seoKeywords    = "M.V. High School gallery, school photos Mumbai, campus life Charni Road, school events gallery";
$seoCanonical   = BASE_URL . "/gallery.php";
$seoImage       = BASE_URL . "/assets/PamphletImage.jpg";
$seoType        = "website";

/* ---- DB — unchanged ---- */
$albums = mysqli_query($conn, "SELECT * FROM gallery_albums ORDER BY id DESC");
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
  <link rel="stylesheet" href="gallery.css">
</head>
<body>

<header></header>
<script src="load-header.js?v=3" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="Gallery page hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page">Gallery</span>
    </nav>
    <h1>Campus Life &amp; Gallery</h1>
    <p class="lead">Moments that define the M.V. High School experience — events, sports, arts and more.</p>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);" aria-labelledby="gallery-heading">
  <div class="container">
    <div class="section-header" style="margin-bottom:24px;">
      <div class="eyebrow">Photo Albums</div>
      <h2 id="gallery-heading" style="color:var(--navy);">Gallery Albums</h2>
    </div>

    <?php
    $album_arr = [];
    while($a = mysqli_fetch_assoc($albums)) $album_arr[] = $a;
    ?>

    <?php if(count($album_arr) > 0): ?>
    <div class="gallery-grid">
      <?php foreach($album_arr as $a):
        if (!empty($a['cover_image'])) {
          $path  = ltrim($a['cover_image'], '/');
          $cover = '/' . str_replace('%2F','/', rawurlencode($path));
        } else {
          $cover = 'assets/PamphletImage.jpg';
        }
        $slug  = urlencode($a['slug']);
        $name  = htmlspecialchars($a['album_name']);
      ?>
      <a
        href="gallery-view.php?slug=<?= $slug ?>"
        class="gallery-card"
        aria-label="View <?= $name ?> album"
      >
        <img
          src="<?= $cover ?>"
          alt="<?= $name ?> — M.V. High School gallery"
          loading="lazy"
          width="320"
          height="200"
          onerror="this.src='assets/PamphletImage.jpg';"
        >
        <h3><?= $name ?></h3>
      </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state">
      <p>Gallery albums are being added. Please check back soon.</p>
    </div>
    <?php endif; ?>

  </div>
</section>

</main>

<script src="footer.js" defer></script>
</body>
</html>