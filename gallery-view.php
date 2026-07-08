<?php
include "db.php";
include "config.php";

// 1) Validate slug
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
if ($slug === '') {
    die("Invalid album.");
}

if (!isset($conn) || !$conn) {
    die("Database connection error.");
}

// 2) Secure query (prepared statement — unchanged)
$stmt = mysqli_prepare($conn, "SELECT * FROM gallery_albums WHERE slug = ?");
if (!$stmt) {
    die("Album not found.");
}
mysqli_stmt_bind_param($stmt, "s", $slug);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$album  = mysqli_fetch_assoc($result);

if (!$album) {
    die("Album not found.");
}

$album_id = (int)$album['id'];
$album_name = htmlspecialchars($album['album_name']);

// Helper: build safe URL for paths — unchanged
function safe_url_path($path) {
    $path = ltrim($path, '/');
    return '/' . str_replace('%2F','/', rawurlencode($path));
}

// Fetch photos
$photos_result = mysqli_query($conn, "SELECT photo_path FROM gallery_photos WHERE album_id = $album_id ORDER BY id ASC");
$photos = [];
while($p = mysqli_fetch_assoc($photos_result)) {
    $photos[] = safe_url_path($p['photo_path']);
}

$photo_count = count($photos);

// SEO
include "config.php";
$seoTitle   = $album_name . " | Gallery | M.V. High School";
$seoCanonical = BASE_URL . "/gallery-view.php?slug=" . urlencode($slug);
$seoImage   = BASE_URL . "/assets/PamphletImage.jpg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= $seoTitle ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="View photos from the <?= $album_name ?> album — M.V. High School gallery.">
  <link rel="canonical" href="<?= $seoCanonical ?>">
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="styles.css?v=7">
  <link rel="stylesheet" href="main.css?v=7">
  <link rel="stylesheet" href="gallery.css">

  <style>
  .photo-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 16px;
    margin-top: 24px;
  }
  </style>
</head>
<body>

<header></header>
<script src="load-header.js?v=7" defer></script>

<!-- PAGE HERO -->
<section class="page-hero" aria-label="<?= $album_name ?> album hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span class="sep" aria-hidden="true">›</span>
      <a href="gallery.php">Gallery</a>
      <span class="sep" aria-hidden="true">›</span>
      <span class="current" aria-current="page"><?= $album_name ?></span>
    </nav>
    <h1><?= $album_name ?></h1>
    <p class="lead">
      <?php if($photo_count > 0): ?>
        <?= $photo_count ?> photo<?= $photo_count !== 1 ? 's' : '' ?> in this album.
      <?php else: ?>
        No photos uploaded yet for this album.
      <?php endif; ?>
    </p>
  </div>
</section>

<main id="main-content">

<section class="section" style="background:var(--surface);">
  <div class="container">

    <div style="margin-bottom:16px;">
      <a href="gallery.php" class="btn btn-ghost btn-sm">← Back to Albums</a>
    </div>

    <?php if($photo_count > 0): ?>
    <div class="photo-gallery-grid" id="photoGrid" aria-label="Gallery photos">
      <?php foreach($photos as $idx => $fullPath): ?>
      <div
        class="gallery-photo-wrap"
        style="position:relative;"
      >
        <img
          src="<?= $fullPath ?>"
          class="gallery-photo"
          loading="lazy"
          alt="<?= $album_name ?> — photo <?= $idx + 1 ?>"
          width="300"
          height="240"
          onclick="openLightbox(<?= $idx ?>)"
          role="button"
          tabindex="0"
          onkeydown="if(event.key==='Enter'||event.key===' ') openLightbox(<?= $idx ?>)"
          aria-label="View photo <?= $idx + 1 ?> of <?= $photo_count ?> in <?= $album_name ?>"
        >
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="empty-state">
      <p>No photos have been uploaded for this album yet.</p>
      <a href="gallery.php" class="btn btn-secondary" style="margin-top:14px;">Browse Other Albums</a>
    </div>
    <?php endif; ?>

  </div>
</section>

</main>

<!-- LIGHTBOX — accessible, keyboard + swipe -->
<?php if($photo_count > 0): ?>
<div
  class="lightbox-overlay"
  id="lightboxOverlay"
  role="dialog"
  aria-modal="true"
  aria-label="Photo lightbox"
  aria-live="polite"
>
  <button class="lightbox-close" id="lightboxClose" aria-label="Close lightbox" type="button">✕</button>

  <div class="lightbox-inner">
    <button class="lightbox-nav lightbox-prev" id="lightboxPrev" aria-label="Previous photo" type="button">‹</button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="" width="960" height="700">
    <button class="lightbox-nav lightbox-next" id="lightboxNext" aria-label="Next photo" type="button">›</button>
  </div>

  <div class="lightbox-counter" id="lightboxCounter" aria-live="polite"></div>
</div>

<script>
(function() {
  var photos  = <?= json_encode($photos) ?>;
  var names   = <?= json_encode(array_map(function($i) use ($album_name, $photo_count) { return $album_name . ' — photo ' . ($i+1) . ' of ' . $photo_count; }, array_keys($photos))) ?>;
  var total   = photos.length;
  var current = 0;
  var overlay = document.getElementById('lightboxOverlay');
  var img     = document.getElementById('lightboxImg');
  var counter = document.getElementById('lightboxCounter');
  var lastFocus;

  function updateLightbox() {
    img.src = photos[current];
    img.alt = names[current];
    counter.textContent = (current + 1) + ' / ' + total;
  }

  window.openLightbox = function(idx) {
    lastFocus = document.activeElement;
    current   = idx;
    updateLightbox();
    overlay.classList.add('open');
    overlay.style.display = 'flex';
    document.body.classList.add('menu-open');
    document.getElementById('lightboxClose').focus();
  };

  function closeLightbox() {
    overlay.classList.remove('open');
    overlay.style.display = 'none';
    document.body.classList.remove('menu-open');
    if (lastFocus) lastFocus.focus();
  }

  function prevPhoto() {
    current = (current - 1 + total) % total;
    updateLightbox();
  }

  function nextPhoto() {
    current = (current + 1) % total;
    updateLightbox();
  }

  document.getElementById('lightboxClose').addEventListener('click', closeLightbox);
  document.getElementById('lightboxPrev').addEventListener('click', prevPhoto);
  document.getElementById('lightboxNext').addEventListener('click', nextPhoto);

  overlay.addEventListener('click', function(e) {
    if (e.target === overlay) closeLightbox();
  });

  document.addEventListener('keydown', function(e) {
    if (!overlay.classList.contains('open')) return;
    if (e.key === 'Escape')      closeLightbox();
    if (e.key === 'ArrowLeft')   prevPhoto();
    if (e.key === 'ArrowRight')  nextPhoto();
  });

  /* Touch swipe */
  var touchStartX = null;
  overlay.addEventListener('touchstart', function(e) {
    touchStartX = e.changedTouches[0].screenX;
  }, { passive: true });

  overlay.addEventListener('touchend', function(e) {
    if (touchStartX === null) return;
    var diff = touchStartX - e.changedTouches[0].screenX;
    if (Math.abs(diff) > 50) {
      if (diff > 0) nextPhoto(); else prevPhoto();
    }
    touchStartX = null;
  });
})();
</script>
<?php endif; ?>

<script src="footer.js?v=7" defer></script>
</body>
</html>
