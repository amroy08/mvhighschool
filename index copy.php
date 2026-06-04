<?php
include "db.php";

// Load Hero Section Title + Subtitle
$hero = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM home_hero WHERE id=1"));

// Load Multiple Hero Images for Slideshow
$hero_images = mysqli_query($conn, "SELECT * FROM home_hero_images ORDER BY id DESC");

// Load Why Choose Us
$choose_us = mysqli_query($conn, "SELECT * FROM choose_us ORDER BY id ASC");

// Load NEWS & EVENTS instead of events
$updates = mysqli_query($conn, "SELECT * FROM news_events ORDER BY event_date DESC LIMIT 3");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>M.V. High School | Excellence in Education</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="premium-header.css">

<style>
/* ===== HERO SLIDESHOW ===== */
.slideshow-container {
  position: relative;
  width: 100%;
  height: 350px;
  overflow: hidden;
  border-radius: 20px;
}

.slide-img {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0;
  transition: opacity 1.5s ease-in-out;
}

/* clickable cards */
.why-card {
  cursor: pointer;
  transition: .2s;
  text-decoration: none;
  color: inherit;
}

.why-card:hover {
  transform: translateY(-4px);

  /* ENTRY ANIMATION */
.why-card {
  opacity: 0;
  transform: translateY(20px);
  animation: fadeUp 0.8s ease forwards;
}

/* Delay each card slightly */
.why-card:nth-child(1) { animation-delay: 0.1s; }
.why-card:nth-child(2) { animation-delay: 0.25s; }
.why-card:nth-child(3) { animation-delay: 0.4s; }
.why-card:nth-child(4) { animation-delay: 0.55s; }
.why-card:nth-child(5) { animation-delay: 0.7s; }

@keyframes fadeUp {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

}

/* POPUP BACKDROP */
.modal-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; 
  height: 100%;
  background: rgba(0,0,0,0.6);
  display: none;        /* HIDDEN BY DEFAULT */
  justify-content: center;
  align-items: center;
  z-index: 9999 !important;
}

/* POPUP BOX */
.modal-box {
  background: #ffffff;
  padding: 25px;
  border-radius: 16px;
  width: 90%;
  max-width: 450px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.25);
  position: relative;
  animation: popIn .35s ease;
}

@keyframes popIn {
  0% {
    opacity: 0;
    transform: scale(0.85);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

.close-modal {
  position: absolute;
  right: 15px;
  top: 10px;
  font-size: 28px;
  cursor: pointer;
  color: #333;
}

.modal-box input,
.modal-box textarea {
  width: 100%;
  margin-top: 8px;
  padding: 10px;
  border: 1px solid #c8d0dd;
  border-radius: 8px;
  font-size: 14px;
}

</style>

</head>
<body>

<!-- Header -->
<header></header>
<script src="load-header.js"></script>

<!-- Hero Section -->
<section class="hero">
  <div class="container hero-wrap">

    <div>
      <h1><?= $hero['title'] ?></h1>
      <p><?= $hero['subtitle'] ?></p>

      <div class="actions">
        <a class="btn primary" href="academics.php">Explore Academics</a>
        <a class="btn ghost" href="gallery.php">View Campus Life</a>
      </div>
    </div>

    <div class="media">
      <div class="slideshow-container">
        <?php while($img = mysqli_fetch_assoc($hero_images)) { ?>
            <img class="slide-img" src="<?= $img['image'] ?>">
        <?php } ?>
      </div>
    </div>

  </div>
</section>

<!-- Why Choose Us -->
<section class="section">
  <div class="container">
    <h2>Why Choose Us</h2>
    <p class="lead">A caring culture, strong academics, and a vibrant campus life.</p>

    <div class="why-grid">

      <?php while($row = mysqli_fetch_assoc($choose_us)) { ?>

        <?php
          // Link matching based on card title
          $link = "#";
          if ($row['title'] == "Experienced Faculty") $link = "faculty.php";
          if ($row['title'] == "Holistic Programs") $link = "gallery.php";
          if ($row['title'] == "Modern Facilities") $link = "gallery.php";
        ?>

        <a href="<?= $link ?>" class="why-card">
          <div class="icon">
            <i class="<?= $row['icon'] ?>"></i>
          </div>
          <h4><?= $row['title'] ?></h4>
          <p><?= $row['description'] ?></p>
        </a>

      <?php } ?>

    </div>
  </div>
</section>

<!-- Updates Section -->
<section class="section">
  <div class="container">
    <h2>Updates</h2>
    <p class="lead">What’s happening this month.</p>

    <div class="updates-list">

      <?php while($u = mysqli_fetch_assoc($updates)) { ?>
      <div class="update-item" 
           onclick="location.href='news-details.php?slug=<?= $u['slug'] ?>'" 
           style="cursor:pointer;">
        <strong><?= $u['title'] ?></strong>
        <span><?= date('M d, Y', strtotime($u['event_date'])) ?> • <?= $u['location'] ?></span>
      </div>
      <?php } ?>

    </div>

  </div>
</section>

<!-- ===================== AUTO POPUP MODAL ===================== -->
<div id="admissionModal" class="modal-overlay">
  <div class="modal-box">
    
    <span class="close-modal" onclick="closeModal()">×</span>

    <h2>Admission Enquiry</h2>
    <p>Fill the form and our team will contact you.</p>

    <form action="submit-admission.php" method="POST">

      <label>Student Name</label>
      <input type="text" name="student_name" required>

      <label>Parent Name</label>
      <input type="text" name="parent_name" required>

      <label>Class Seeking Admission</label>
      <input type="text" name="class" required>

      <label>Phone Number</label>
      <input type="text" name="phone" required>

      <label>Message</label>
      <textarea name="message"></textarea>

      <button type="submit" class="btn primary" style="margin-top:10px;">Submit</button>

    </form>

  </div>
</div>

</script>

<script>
function closeModal() {
  document.getElementById("admissionModal").style.display = "none";
  sessionStorage.setItem("admissionPopupShown", "yes"); 
}

window.onload = function() {
  if (!sessionStorage.getItem("admissionPopupShown")) {
      document.getElementById("admissionModal").style.display = "flex";
  }
};
</script>

<!-- Footer -->
<script src="footer.js"></script>

<!-- SLIDESHOW SCRIPT -->
<script>


let slides = document.querySelectorAll(".slide-img");
let index = 0;

function showSlide() {
    slides.forEach((img, i) => {
        img.style.opacity = (i === index ? "1" : "0");
    });

    index = (index + 1) % slides.length;
}

if (slides.length > 0) {
    showSlide();
    setInterval(showSlide, 4000);
}

</script>
</body>
</html>
