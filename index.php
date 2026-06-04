<?php
include "db.php";

$seoTitle = "Best School in Charni Road, Mumbai | M.V. High School Admissions Open";

$seoDescription = "M.V. High School in Charni Road, Mumbai offers English Medium from Nursery to 10th and Hindi Medium for Secondary 8th to 10th. Admissions open with smart classrooms, sports, and holistic development.";

$seoKeywords = "best school in Charni Road, school in Mumbai, English medium school Mumbai, Hindi medium school Mumbai, nursery to 10th school, admissions open Mumbai";

$seoCanonical = "https://mvhighschool.in/";

$seoImage = "https://mvhighschool.in/assets/PamphletImage.jpg";

$seoType = "website";

// Load Hero Section Title + Subtitle
$hero = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM home_hero WHERE id=1"));

// Load Multiple Hero Images for Slideshow
$hero_images = mysqli_query($conn, "SELECT * FROM home_hero_images ORDER BY id DESC");

// Load Why Choose Us
$choose_us = mysqli_query($conn, "SELECT * FROM choose_us ORDER BY id ASC");

// Load Latest News & Events
$updates = mysqli_query($conn, "SELECT * FROM news_events ORDER BY event_date DESC LIMIT 3");
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


  /* Why Choose Us Animation */
  .why-card {
    cursor: pointer;
    transition: .2s;
    text-decoration: none;
    color: inherit;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.8s ease forwards;
  }

  .why-card:nth-child(1) { animation-delay: 0.1s; }
  .why-card:nth-child(2) { animation-delay: 0.25s; }
  .why-card:nth-child(3) { animation-delay: 0.4s; }
  .why-card:nth-child(4) { animation-delay: 0.55s; }
  .why-card:nth-child(5) { animation-delay: 0.7s; }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* POPUP */
  .modal-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .modal-box {
    background: #ffffff;
    padding: 25px;
    border-radius: 16px;
    width: 90%;
    max-width: 900px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    position: relative;
  }

  .close-modal {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 28px;
    cursor: pointer;
    color: #333;
  }

  /* =========================================================
   ADMISSION FORM + PAMPHLET SIDE-BY-SIDE LAYOUT
   ========================================================= */

.admission-layout {
  display: grid;
  grid-template-columns: 1.2fr 1fr;   /* Form wider, pamphlet smaller */
  gap: 25px;
  align-items: start;
  max-width: 900px;
}

.admission-form {
  width: 100%;
   max-height: 85vh;
  overflow-y: auto;
  padding-right: 12px;
}

.admission-pamphlet {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.admission-pamphlet img {
  width: 100%;
  height: auto;
  max-height: 85vh;      /* Prevents cutting */
  object-fit: contain;
  border-radius: 12px;
  box-shadow: 0px 4px 20px rgba(0,0,0,0.15);
}


/* Mobile Responsive */
@media (max-width: 768px) {

  .admission-pamphlet {
    order: -1;                 /* image comes first */
    margin-bottom: 16px;
  }

  .admission-pamphlet img {
    width: 100%;
    height: auto;              /* ✅ natural height */
    max-height: none; 
    min-height: 320px;/* ✅ no restriction */
    object-fit: contain;
    border-radius: 12px;
  }

}

/* ================================
   ADMISSION POPUP – FIXED RESPONSIVE
   ================================ */

/* Desktop (default) */
.modal-box.admission-layout {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 25px;
  max-height: 90vh;
  overflow: hidden;
}

/* Form scroll only */
.admission-form {
  overflow-y: auto;
  max-height: 85vh;
  padding-right: 10px;
}

/* Mobile Fix */
@media (max-width: 768px) {

  .modal-overlay {
    align-items: flex-start;
  }

  .modal-box.admission-layout {
    width: 100%;
    height: 100%;
    max-height: 100vh;
    border-radius: 0;
    padding: 16px;
    grid-template-columns: 1fr;
    overflow-y: auto;
  }

  .close-modal {
    position: fixed;
    top: 12px;
    right: 15px;
    font-size: 30px;
    z-index: 10000;
    background: #fff;
    border-radius: 50%;
    padding: 4px 10px;
  }

  .admission-pamphlet {
    order: -1;
    margin-bottom: 15px;
  }

  .admission-pamphlet img {
    max-height: 260px;
    width: 100%;
    object-fit: contain;
    border-radius: 10px;
  }

  .admission-form {
    max-height: none;
    overflow: visible;
    padding-right: 0;
  }

  .admission-form h2 {
    text-align: center;
    font-size: 20px;
  }

  .admission-form input,
  .admission-form textarea {
    font-size: 15px;
    padding: 10px;
  }

  .admission-form button {
    width: 100%;
    padding: 12px;
    font-size: 16px;
  }
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

<!-- HEADER (AUTO LOAD FROM header.php) -->
<header></header>
<script src="load-header.js?v=2"></script>

<?php if(isset($_GET['success'])) { ?>
<div style="background:#d1fae5;color:#065f46;padding:14px;text-align:center;font-weight:600;">
  Admission enquiry submitted successfully.
</div>
<?php } ?>

<?php if(isset($_GET['error'])) { ?>
<div style="background:#fee2e2;color:#991b1b;padding:14px;text-align:center;font-weight:600;">
  Something went wrong. Please fill all required details and try again.
</div>
<?php } ?>

<div class="seo-hidden-content">
  M.V. High School in Charni Road, Mumbai offers English Medium education from Nursery to 10th standard and Hindi Medium education for Secondary classes from 8th to 10th standard. The school provides interactive learning, personal development, group activities, diverse sports offerings, rifle shooting, smart board classrooms, audio visual rooms, and holistic development. Learn more on our <a href="about.php">About Us</a> page, check <a href="admissions.php">Admissions</a>, explore <a href="academics.php">Academics</a>, view <a href="gallery.php">Campus Life</a>, and <a href="contact.php">Contact Us</a>.
</div>

<!-- HERO SECTION -->
<section class="hero">
  <div class="container hero-wrap">

    <div>
      <h1>Best School in Charni Road, Mumbai - M.V. High School</h1>
      <p><?= $hero['subtitle'] ?></p>

      <div class="actions">
        <a class="btn primary" href="academics.php">Explore Academics</a>
        <a class="btn ghost" href="gallery.php">View Campus Life</a>
        <a class="btn primary" href="admissions.php">Apply for Admission</a>
      </div>
    </div>

    <div class="media">
      <div class="slideshow-container">
        <?php while($img = mysqli_fetch_assoc($hero_images)) { ?>
          <img class="slide-img" src="<?= $img['image'] ?>" alt="M.V. High School students and campus activities" loading="lazy">
        <?php } ?>
      </div>
    </div>

  </div>
</section>

<!-- SEO CONTENT SECTION -->
<section class="section">
  <div class="container">

    <h2>English Medium and Hindi Medium School in Mumbai</h2>

    <p>
      M.V. High School located in Charni Road, Mumbai offers English Medium education from Nursery to 10th standard and Hindi Medium education for Secondary classes from 8th to 10th standard.
    </p>

    <p>
      Our school provides interactive learning, personal development, group activities, sports, rifle shooting, smart board classrooms, audio visual rooms, and holistic student development.
    </p>

  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="section">
  <div class="container">
    <h2>Why Choose M.V. High School</h2>
    <p class="lead">A caring culture, strong academics, and a vibrant campus life.</p>

    <div class="why-grid">

      <?php while($row = mysqli_fetch_assoc($choose_us)) { 
        $link = "#";
        if ($row['title'] == "Experienced Faculty") $link = "faculty.php";
        if ($row['title'] == "Holistic Programs") $link = "gallery.php";
        if ($row['title'] == "Modern Facilities") $link = "gallery.php";
      ?>

      <a href="<?= $link ?>" class="why-card">
        <div class="icon"><i class="<?= $row['icon'] ?>"></i></div>
        <h4><?= $row['title'] ?></h4>
        <p><?= $row['description'] ?></p>
      </a>

      <?php } ?>

    </div>
  </div>
</section>


<!-- UPDATES SECTION -->
<section class="section">
  <div class="container">
    <h2>Latest School News & Events</h2>
    <p class="lead">What’s happening this month.</p>

    <div class="updates-list">

      <?php while($u = mysqli_fetch_assoc($updates)) { ?>

        <?php
          // Safe date handling
          $dateText = "Date not announced";
          if (!empty($u['event_date'])) {
            $t = strtotime($u['event_date']);
            if ($t) {
              $dateText = date('M d, Y', $t);
            }
          }
        ?>

        <div class="update-item"
             onclick="location.href='news-details.php?id=<?= (int)$u['id'] ?>'"
             style="cursor:pointer;">

          <strong><?= htmlspecialchars($u['title']) ?></strong>

          <span>
            <?= htmlspecialchars($dateText) ?> •
            <?= htmlspecialchars($u['status']) ?>
          </span>

        </div>

      <?php } ?>

    </div>

  </div>
</section>


<!-- ADMISSION POPUP -->
<div id="admissionModal" class="modal-overlay">
  <div class="modal-box admission-layout">

    <span class="close-modal" onclick="closeModal()">×</span>

    <!-- LEFT SIDE : FORM -->
    <div class="admission-form">
      <h2>Admission Enquiry</h2>

      <form action="save-enquiry.php" method="POST">

  <label>Student Name</label>
  <input type="text" name="student" required>

  <label>Parent Name</label>
  <input type="text" name="parent" required>
  
  <label>Expected Admission Year</label>
<select name="academic_year" required>
  <option value="">Select Academic Year</option>
  <option value="AY 2026-2027">AY 2026-2027</option>
</select>

  <label>Grade Seeking Admission</label>

  <select name="class" required>
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

  <label>Phone Number</label>
  <input type="text" name="phone" required>

  <label>Email Address</label>
  <input type="email" name="email" required>

  <label>Message</label>
  <textarea name="message"></textarea>

  <button type="submit" class="btn primary" style="margin-top:10px;">
    Submit
  </button>

</form>
    </div>

    <!-- RIGHT SIDE : PAMPHLET -->
    <div class="admission-pamphlet">
      <img src="assets/PamphletImage.jpg" alt="M.V. High School admission pamphlet for English Medium and Hindi Medium" loading="lazy">
    </div>

  </div>
</div>


<!-- POPUP + SLIDESHOW -->
<script>
document.addEventListener("DOMContentLoaded", function() {

    /* --------------------------
       1) POPUP SHOW ONLY ONCE
    --------------------------- */
   const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has("success")) {
    sessionStorage.setItem("admissionPopupShown", "yes");
}

if (!sessionStorage.getItem("admissionPopupShown")) {
    const modal = document.getElementById("admissionModal");
    if (modal) modal.style.display = "flex";
}

    /* --------------------------
       2) SLIDESHOW CODE
    --------------------------- */
    let slides = document.querySelectorAll(".slide-img");
    let index = 0;

    function showSlide() {
        slides.forEach((img, i) => {
            img.style.opacity = (i === index ? "1" : "0");
        });
        index = (index + 1) % slides.length;
    }

    if (slides.length > 1) {
        showSlide();
        setInterval(showSlide, 4000);
    }
});
</script>

<script>
function closeModal() {
  document.getElementById("admissionModal").style.display = "none";
  sessionStorage.setItem("admissionPopupShown", "yes");
}
</script>

<script src="footer.js"></script>

</body>
</html>