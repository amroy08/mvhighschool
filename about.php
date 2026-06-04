<?php
include "db.php";

/* SEO VARIABLES */
$seoTitle = "About M.V. High School | Charni Road, Mumbai";
$seoDescription = "Learn about M.V. High School in Charni Road, Mumbai offering English Medium from Nursery to 10th and Hindi Medium education with strong academics, values, leadership, and student development.";
$seoKeywords = "About M.V. High School, school in Charni Road, school in Mumbai, English medium school Mumbai, Hindi medium school Mumbai";
$seoCanonical = "https://mvhighschool.in/about.php";
$seoImage = "https://mvhighschool.in/assets/PamphletImage.jpg";
$seoType = "website";

// PRINCIPAL
$principal = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_principal ORDER BY id DESC LIMIT 1"));

// TRUSTEE
$trustee = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_trustee ORDER BY id DESC LIMIT 1"));

// LEADERSHIP TEAM
$teamResult = mysqli_query($conn, "SELECT * FROM about_leadership_team ORDER BY id ASC");

// JOURNEY / TIMELINE
$journeyResult = mysqli_query($conn, "SELECT * FROM about_journey ORDER BY year ASC");

// MISSION / VISION / VALUES
$mission = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_mvv WHERE type='mission'"));
$vision  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_mvv WHERE type='vision'"));
$values  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_mvv WHERE type='values'"));
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <?php include "seo.php"; ?>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="/favicon.png">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="premium-header.css">

  <style>
    body {
      background: #f5f7fa;
      font-family: Arial, sans-serif;
      scroll-behavior: smooth;
    }

    .wrapper {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .fade-in {
      animation: fadeIn 1.2s ease forwards;
      opacity: 0;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    h2.section-title {
      font-size: 2rem;
      margin-bottom: 20px;
      text-align: center;
      color: #003366;
      position: relative;
    }

    h2.section-title::after {
      content: "";
      width: 60px;
      height: 3px;
      background: #003366;
      display: block;
      margin: 10px auto;
      border-radius: 3px;
    }

    .section-menu {
      display: flex;
      gap: 15px;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 25px;
    }

    .section-menu a {
      background: #003366;
      color: white;
      padding: 10px 18px;
      border-radius: 30px;
      font-size: 14px;
      text-decoration: none;
      transition: 0.3s;
    }

    .section-menu a:hover {
      background: #00509e;
      transform: translateY(-3px);
    }

    @media(max-width: 600px) {
      .section-menu {
        flex-direction: column;
        align-items: center;
      }
    }

    /* PRINCIPAL + TRUSTEE TWO COLUMN SECTION */
    .about-top-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      align-items: start;
    }

    .principal-block-title {
      font-size: 2rem;
      margin-bottom: 20px;
      text-align: center;
      color: #003366;
      position: relative;
    }

    .principal-block-title::after {
      content: "";
      width: 60px;
      height: 3px;
      background: #003366;
      display: block;
      margin: 10px auto;
      border-radius: 3px;
    }

    .principal-card {
      display: grid;
      grid-template-columns: 180px 1fr;
      gap: 20px;
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 3px 12px rgba(0,0,0,0.1);
      align-items: start;
      transition: 0.3s;
      height: 100%;
    }

    .principal-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .principal-img {
      width: 100%;
      max-width: 180px;
      border-radius: 10px;
      overflow: hidden;
      border: 1px solid rgba(0,0,0,0.08);
      background: #f7f7f7;
    }

    .principal-img img {
      width: 100%;
      height: auto;
      display: block;
      object-fit: cover;
    }

    .principal-content h3 {
      margin: 0 0 6px;
      font-size: 18px;
      color: #0b2a4a;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .principal-content .designation {
      margin: 0 0 14px;
      font-weight: 700;
      color: #4b5563;
      text-transform: uppercase;
      font-size: 12px;
    }

    .principal-content p {
      margin: 0 0 10px;
      line-height: 1.7;
      font-size: 13px;
      color: #111827;
    }

    @media(max-width: 992px) {
      .about-top-grid {
        grid-template-columns: 1fr;
      }
    }

    @media(max-width: 768px) {
      .principal-card {
        grid-template-columns: 1fr;
        text-align: center;
      }

      .principal-img {
        max-width: 220px;
        margin: 0 auto;
      }
    }

    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
    }

    .team-card {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.08);
      text-align: center;
      transition: 0.3s;
    }

    .team-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .team-card img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
      transition: 0.3s;
    }

    .team-card:hover img {
      transform: scale(1.05);
    }

    .mvv-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .mvv-card {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      transition: 0.3s;
    }

    .mvv-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .timeline {
      border-left: 3px solid #003366;
      padding-left: 20px;
      margin-top: 20px;
    }

    .timeline-item {
      margin-bottom: 30px;
      position: relative;
      animation: fadeIn 1.2s ease;
    }

    .timeline-item::before {
      content: "";
      width: 14px;
      height: 14px;
      background: #003366;
      border-radius: 50%;
      position: absolute;
      left: -29px;
      top: 5px;
    }

    .timeline-item img {
      max-width: 260px;
      border-radius: 8px;
      margin-top: 10px;
      transition: 0.3s;
    }

    .timeline-item img:hover {
      transform: scale(1.05);
    }

    .seo-hidden-h1 {
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

<h1 class="seo-hidden-h1">About M.V. High School in Charni Road, Mumbai</h1>

<div class="wrapper">

  <div class="section-menu fade-in">
    <a href="#principal">Principal</a>
    <a href="#team">Leadership Team</a>
    <a href="#mvv">Mission & Vision</a>
    <a href="#journey">School Journey</a>
  </div>

  <?php if ($principal || $trustee) { ?>
    <div id="principal" class="about-top-grid fade-in">

      <?php if ($principal) { ?>
        <div>
          <h2 class="principal-block-title">Message from the Principal</h2>
          <div class="principal-card">
            <div class="principal-img">
              <img src="assets/<?php echo $principal['image']; ?>" alt="Principal of M.V. High School">
            </div>
            <div class="principal-content">
              <h3><?php echo $principal['name']; ?></h3>
              <p class="designation"><?php echo $principal['designation']; ?></p>
              <p><?php echo nl2br($principal['message']); ?></p>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php if ($trustee) { ?>
        <div>
          <h2 class="principal-block-title">Message from the Trustee</h2>
          <div class="principal-card">
            <div class="principal-img">
              <img src="assets/<?php echo $trustee['image']; ?>" alt="Trustee of M.V. High School">
            </div>
            <div class="principal-content">
              <h3><?php echo $trustee['name']; ?></h3>
              <p class="designation"><?php echo $trustee['designation']; ?></p>
              <p><?php echo nl2br($trustee['message']); ?></p>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  <?php } ?>

  <br><br>

  <h2 class="section-title" id="team">Leadership Team</h2>
  <div class="team-grid fade-in">
    <?php while($t = mysqli_fetch_assoc($teamResult)) { ?>
      <div class="team-card">
        <img src="assets/<?php echo $t['image']; ?>" alt="Leadership team member at M.V. High School">
        <h3><?php echo $t['name']; ?></h3>
        <p class="designation"><?php echo $t['designation']; ?></p>
        <p><?php echo nl2br($t['message']); ?></p>
      </div>
    <?php } ?>
  </div>

  <br><br>

  <h2 class="section-title" id="mvv">Our Mission, Vision & Values</h2>
  <div class="mvv-grid fade-in">
    <div class="mvv-card">
      <h3>Mission</h3>
      <p><?php echo nl2br($mission['content']); ?></p>
    </div>
    <div class="mvv-card">
      <h3>Vision</h3>
      <p><?php echo nl2br($vision['content']); ?></p>
    </div>
    <div class="mvv-card">
      <h3>Values</h3>
      <p><?php echo nl2br($values['content']); ?></p>
    </div>
  </div>

  <br><br>

  <h2 class="section-title" id="journey">Our School Journey</h2>
  <div class="timeline fade-in">
    <?php while($j = mysqli_fetch_assoc($journeyResult)) { ?>
      <div class="timeline-item">
        <h3><?php echo $j['year']; ?> — <?php echo $j['title']; ?></h3>
        <p><?php echo nl2br($j['description']); ?></p>
        <?php if ($j['image']) { ?>
          <img src="assets/<?php echo $j['image']; ?>" alt="M.V. High School journey milestone">
        <?php } ?>
      </div>
    <?php } ?>
  </div>

</div>

<script src="footer.js"></script>

</body>
</html>