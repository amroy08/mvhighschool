<?php
include "db.php";

// 1) Validate slug
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
if ($slug === '') {
    die("Invalid album.");
}

// 2) Secure query (prepared statement)
$stmt = mysqli_prepare($conn, "SELECT * FROM gallery_albums WHERE slug = ?");
mysqli_stmt_bind_param($stmt, "s", $slug);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$album = mysqli_fetch_assoc($result);

if (!$album) {
    die("Album not found.");
}

$album_id = (int)$album['id'];

// Helper: build safe URL for paths (handles spaces, keeps slashes)
function safe_url_path($path) {
    $path = ltrim($path, '/');                      // remove starting slash
    return '/' . str_replace('%2F','/', rawurlencode($path)); // encode but keep /
}
?>
<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($album['album_name']) ?> | Gallery</title>
  <link rel="stylesheet" href="premium-header.css">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="gallery.css">
</head>

<body>

<header></header>
<script src="load-header.js"></script>

<section class="section">
  <div class="container">

    <h2><?= htmlspecialchars($album['album_name']) ?></h2>
    <p class="lead">Gallery photos of the selected activity.</p>

    <div class="gallery-grid">

      <?php
      $photos = mysqli_query($conn, "SELECT photo_path FROM gallery_photos WHERE album_id = $album_id ORDER BY id DESC");

      if (mysqli_num_rows($photos) == 0) {
          echo "<p class='lead'>No photos uploaded yet.</p>";
      } else {
          while ($p = mysqli_fetch_assoc($photos)) {
              // ✅ Correct: no /mvschool/ + handle spaces/brackets
              $fullPath = safe_url_path($p['photo_path']);
              echo "<img src='{$fullPath}' class='gallery-photo' loading='lazy' alt='Gallery Photo'>";
          }
      }
      ?>

    </div>

    <a href="gallery.php" class="btn primary" style="margin-top:20px;">← Back to Albums</a>

  </div>
</section>

<script src="footer.js"></script>
</body>
</html>
