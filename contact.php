<?php
include "db.php";

/* SEO VARIABLES */
$seoTitle = "Contact M.V. High School | Charni Road, Mumbai";
$seoDescription = "Contact M.V. High School in Charni Road, Mumbai for admissions, school enquiries, address, phone number, and email details.";
$seoKeywords = "M.V. High School contact, school contact Mumbai, school address Charni Road, school phone number Mumbai, contact school";
$seoCanonical = "https://mvhighschool.in/contact.php";
$seoImage = "https://mvhighschool.in/assets/PamphletImage.jpg";
$seoType = "website";

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM school_contact WHERE id=1"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php include "seo.php"; ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="stylesheet" href="styles.css">
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

<div class="seo-hidden-content">
  Contact M.V. High School in Charni Road, Mumbai for admissions, school enquiries, address, phone number, and email details. Learn more about our <a href="about.php">About Us</a>, check <a href="admissions.php">Admissions</a>, explore <a href="academics.php">Academics</a>, and view <a href="gallery.php">Campus Life</a>.
</div>

<section class="section">
<div class="container">

<h1>Contact M.V. High School</h1>

<div class="contact-grid">
  <div class="contact-box">
    <h2>Address</h2>
    <p><?= nl2br($data['address']) ?></p>
  </div>

  <div class="contact-box">
    <h2>Phone</h2>
    <p><?= $data['phone'] ?></p>
  </div>

  <div class="contact-box">
    <h2>Email</h2>
    <p><?= $data['email'] ?></p>
  </div>
</div>

</div>
</section>

<script src="footer.js"></script>
</body>
</html>