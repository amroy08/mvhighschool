<?php include "db.php"; 

/* SEO VARIABLES */
$seoTitle = "Academics | M.V. High School, Mumbai";
$seoDescription = "Explore academic programs at M.V. High School, Charni Road, Mumbai offering English Medium from Nursery to 10th and Hindi Medium for Secondary classes with a strong curriculum and future-ready education.";
$seoKeywords = "school academics Mumbai, M.V. High School academics, English medium curriculum, Hindi medium school Mumbai, school curriculum nursery to 10th";
$seoCanonical = "https://mvhighschool.in/academics.php";
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
  <link rel="stylesheet" href="academics.css"> <!-- NEW FILE -->
  <script src="academics.js" defer></script>
  <link rel="stylesheet" href="premium-header.css">

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

<!-- Hidden SEO Content -->
<div class="seo-hidden-content">
  M.V. High School in Charni Road, Mumbai offers structured academic programs for English Medium from Nursery to 10th standard and Hindi Medium education for Secondary classes from 8th to 10th standard. Students receive a strong academic foundation with a balanced curriculum. Learn more about our <a href="about.php">school</a>, check <a href="admissions.php">admissions</a>, explore <a href="gallery.php">campus life</a>, and <a href="contact.php">contact us</a> for details.
</div>

<section class="section">
  <div class="container">

    <!-- MAIN SEO HEADING -->
    <h1>Academic Programs at M.V. High School</h1>

    <p class="lead">
      Curriculum designed for strong foundations and future readiness.
    </p>

    <!-- EXTRA SEO LINE (VISIBLE, SAFE) -->
    <p>
      Our school provides English Medium education from Nursery to 10th standard and Hindi Medium education for Secondary classes, focusing on academic excellence and overall student development.
    </p>

    <!-- LEVEL CARDS -->
    <div class="ac-grid" id="level-list">
      <?php
      $levels = mysqli_query($conn, "SELECT * FROM academic_levels ORDER BY id ASC");
      while ($level = mysqli_fetch_assoc($levels)) {
          echo "
          <article class='ac-card' onclick=\"showGrades({$level['id']}, '{$level['level_name']}')\">
            <h2>{$level['level_name']}</h2>
            <p>Click to view grades & curriculum</p>
          </article>
          ";
      }
      ?>
    </div>

    <!-- GRADE LIST -->
    <div class="ac-grid" id="grade-list" style="display:none;"></div>

    <!-- BOOK TABLE -->
    <div id="book-details" style="display:none;"></div>

  </div>
</section>

<script src="footer.js"></script>
</body>
</html>