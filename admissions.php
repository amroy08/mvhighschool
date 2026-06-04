<?php
include("db.php");

/* SEO VARIABLES */
$seoTitle = "Admissions Open | M.V. High School, Charni Road, Mumbai";
$seoDescription = "Admissions are open at M.V. High School in Charni Road, Mumbai for English Medium Nursery to 10th and Hindi Medium Secondary 8th to 10th. Check eligibility, admission process, required documents, and submit your enquiry.";
$seoKeywords = "M.V. High School admissions, school admissions Mumbai, admissions open Charni Road, English medium school admission, Hindi medium school admission, nursery to 10th admission";
$seoCanonical = "https://mvhighschool.in/admissions.php";
$seoImage = "https://mvhighschool.in/assets/PamphletImage.jpg";
$seoType = "website";

// Fetch editable admission sections
$eligibility = "";
$process = "";
$documents = "";

$q = mysqli_query($conn, "SELECT * FROM admissions_content");

while($row = mysqli_fetch_assoc($q)) {
    if($row["section_name"] == "eligibility") $eligibility = $row["content"];
    if($row["section_name"] == "process") $process = $row["content"];
    if($row["section_name"] == "documents") $documents = $row["content"];
}
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

  <style>

    /* ===============================
       ADMISSION PAGE CUSTOM STYLES
       =============================== */

    /* 3 Column Responsive Grid */
    .admission-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 24px;
      margin-top: 20px;
    }

    /* Card Styling (matches theme) */
    .ad-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 22px;
        box-shadow: var(--shadow);
        transition: .3s ease;
    }

    .ad-card:hover {
        transform: translateY(-6px);
        border-color: var(--gold);
    }

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
  Admissions at M.V. High School, Charni Road, Mumbai are open for English Medium from Nursery to 10th standard and Hindi Medium for Secondary classes from 8th to 10th standard. Parents can review eligibility, admission process, required documents, and submit an enquiry online. Learn more about our <a href="about.php">school</a>, explore <a href="academics.php">academics</a>, view <a href="gallery.php">campus life</a>, and <a href="contact.php">contact us</a> for more details.
</div>

<section class="section">
  <div class="container">

    <h1>Admissions Open at M.V. High School, Mumbai</h1>
    <p class="lead">
      Join our community of learners. We make the admission process simple, transparent, and student-first.
    </p>

    <p>
      M.V. High School in Charni Road, Mumbai offers English Medium education from Nursery to 10th standard and Hindi Medium education for Secondary classes from 8th to 10th standard.
    </p>

    <div class="admission-grid">
      <article class="ad-card">
        <h2>Eligibility</h2>
        <p><?= nl2br($eligibility) ?></p>
      </article>

      <article class="ad-card">
        <h2>Admission Process</h2>
        <p><?= nl2br($process) ?></p>
      </article>

      <article class="ad-card">
        <h2>Documents Required</h2>
        <p><?= nl2br($documents) ?></p>
      </article>
    </div>

    <!-- Enquiry form stays same -->

    <!-- ==========================
         ENQUIRY FORM
         ========================== -->
    <div style="margin-top:40px;">
      <h2>Admission Enquiry</h2>

      <form 
        method="POST"
        action="save-enquiry.php"
        class="admission-grid"
        style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;"
      >

        <div>
          <label>Student’s Name</label>
          <input name="student" placeholder="Full name" required aria-label="Student name">
        </div>

        <div>
          <label>Expected Admission Year</label>
          <select name="academic_year" required aria-label="Expected admission year">
            <option value="">Select Academic Year</option>
            <option value="AY 2026-2027">AY 2026-2027</option>
          </select>
        </div>

        <div>
          <label>Grade Seeking Admission</label>
          <select name="class" required aria-label="Grade seeking admission">
            <option value="">Select Grade</option>
            <option value="Nursery">Nursery</option>
            <option value="Jr. KG">Jr. KG</option>
            <option value="Sr. KG">Sr. KG</option>
            <option value="Grade 1">Grade 1</option>
            <option value="Grade 2">Grade 2</option>
            <option value="Grade 3">Grade 3</option>
            <option value="Grade 4">Grade 4</option>
            <option value="Grade 5">Grade 5</option>
            <option value="Grade 6">Grade 6</option>
            <option value="Grade 7">Grade 7</option>
            <option value="Grade 8">Grade 8</option>
            <option value="Grade 9">Grade 9</option>
            <option value="Grade 10">Grade 10</option>
          </select>
        </div>

        <div>
          <label>Parent’s Name</label>
          <input name="parent" placeholder="Parent/Guardian name" required aria-label="Parent name">
        </div>

        <div>
          <label>Contact Number</label>
          <input name="phone" type="tel" placeholder="+91 XXXXX XXXXX" required aria-label="Contact number">
        </div>

        <div>
          <label>Email</label>
          <input name="email" type="email" placeholder="parent@example.com" required aria-label="Email address">
        </div>

        <!-- full width message box -->
        <div style="grid-column: 1/-1;">
          <label>Message</label>
          <textarea name="message" rows="4" placeholder="Any specific query or note" aria-label="Message"></textarea>
        </div>

        <div>
          <button class="btn primary" style="padding:12px 22px;" type="submit">
            Submit Enquiry
          </button>
        </div>

      </form>
    </div>

  </div>
</section>

<script src="footer.js"></script>
</body>
</html>