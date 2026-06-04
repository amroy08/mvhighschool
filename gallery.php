<?php include "db.php";

/* SEO VARIABLES */
$seoTitle = "Gallery | M.V. High School, Mumbai";
$seoDescription = "Explore the gallery of M.V. High School, Charni Road, Mumbai featuring sports, activities, student events, and campus life.";
$seoKeywords = "M.V. High School gallery, school gallery Mumbai, school activities, student events, sports gallery, campus life Mumbai";
$seoCanonical = "https://mvhighschool.in/gallery.php";
$seoImage = "https://mvhighschool.in/assets/PamphletImage.jpg";
$seoType = "website";

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php include "seo.php"; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="premium-header.css">
  <link rel="stylesheet" href="gallery.css">

  <style>
    .seo-hidden-content {
      position: absolute;
      left: -9999px;
      top: auto;
      width: 1px;
      height: 1px;
      overflow: hidden;
    }
  </style>
</head>
<body>

<header></header>
<script src="load-header.js"></script>

<div class="seo-hidden-content">
  Explore the M.V. High School gallery in Charni Road, Mumbai featuring sports, activities, school programs, student achievements, and campus life. Learn more about our <a href="about.php">school</a>, check <a href="admissions.php">admissions</a>, explore <a href="academics.php">academics</a>, and <a href="contact.php">contact us</a> for more details.
</div>

<section class="section">
  <div class="container">

    <h1>Sports & Activities Gallery</h1>
    <p class="lead">Click an activity below to explore photos from our school programs.</p>

    <div class="gallery-grid">

    <?php
    $albums = mysqli_query($conn, "SELECT * FROM gallery_albums ORDER BY id DESC");

    while ($row = mysqli_fetch_assoc($albums)) {

        $path  = ltrim($row['cover_image'], '/');
        $cover = '/' . str_replace('%2F','/', rawurlencode($path));

        $albumName = htmlspecialchars($row['album_name'], ENT_QUOTES, 'UTF-8');
        $slug = urlencode($row['slug']);

        echo "
        <div class='gallery-card' onclick=\"location.href='gallery-view.php?slug={$slug}'\">
            <img src='{$cover}' alt='M.V. High School {$albumName} gallery' loading='lazy'>
            <h2>{$albumName}</h2>
        </div>";
    }
    ?>

    </div>

  </div>
</section>

<script src="footer.js"></script>
</body>
</html>