<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit();
}

include "../db.php";

// Get stats
$events = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM events"))['total'];
$accomplishments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM accomplishments"))['total'];
$news = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM news_events"))['total'];
$gallery = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM gallery_albums"))['total'];
$academics = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM academic_levels"))['total'];

// About Page Modules
$team = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_team"))['total'];
$timeline = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_timeline"))['total'];
$awards = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_awards"))['total'];
$founder = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_founder_slider"))['total'];
$mv = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_mission_vision"))['total'];
$about_sections = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_sections"))['total'];

// Faculty Count
$faculty = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM faculty"))['total'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard | M.V. High School</title>
<link rel="stylesheet" href="../styles.css">

<style>
.dashboard-container {
  max-width: 1250px;
  margin: 50px auto;
}

.dashboard-title {
  font-size: 30px;
  font-weight: 800;
  margin-bottom: 8px;
}

.dashboard-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 22px;
  margin-top: 30px;
}

.tile {
  background: #ffffff;
  padding: 22px;
  border-radius: 16px;
  border: 1px solid #e5ecf6;
  box-shadow: var(--shadow);
  cursor: pointer;
  transition: 0.25s;
  text-align: center;
}

.tile:hover {
  transform: translateY(-5px);
}

.tile h3 {
  font-size: 20px;
  margin-bottom: 8px;
}

.stat-number {
  font-size: 36px;
  font-weight: 800;
  color: #2563eb;
  margin-top: 10px;
}

.logout-btn {
  background: #dc2626;
  color: #fff !important;
  padding: 10px 16px;
  border-radius: 10px;
  float: right;
  font-weight: 600;
  text-decoration: none;
}

.logout-btn:hover {
  background: #b91c1c;
}
</style>
</head>

<body>

<div class="container dashboard-container">

  <a href="logout.php" class="logout-btn">Logout</a>

  <h1 class="dashboard-title">Admin Dashboard</h1>
  <p class="lead">Welcome, <?= $_SESSION['admin_name'] ?>. Manage your school’s content from one place.</p>

  <div class="dashboard-grid">

    <div class="tile" onclick="location.href='manage-hero-images.php'">
      <h3>🖼 Hero Slideshow</h3>
      <p>Upload multiple hero images</p>
      <div class="stat-number">+</div>
    </div>

    <div class="tile" onclick="location.href='manage-alumni.php'">
      <h3>🎓 Alumni</h3>
      <p>Manage alumni details & achievements</p>
      <div class="stat-number">
        <?php 
        echo mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT COUNT(*) AS total FROM alumni")
        )['total'];
        ?>
      </div>
    </div>

    <div class="tile" onclick="location.href='manage-admissions.php'">
      <h3>🎓 Admissions</h3>
      <p>Eligibility, Process & Enquiries</p>
      <div class="stat-number">—</div>
    </div>

    <div class="tile" onclick="location.href='manage-events.php'">
      <h3>📅 Monthly Activities</h3>
      <p>Manage school events & activities</p>
      <div class="stat-number"><?= $events ?></div>
    </div>

    <div class="tile" onclick="location.href='manage-accomplishments.php'">
      <h3>🏆 Accomplishments</h3>
      <p>Manage school achievements</p>
      <div class="stat-number"><?= $accomplishments ?></div>
    </div>

    <div class="tile" onclick="location.href='manage-news.php'">
      <h3>📰 News & Events</h3>
      <p>Manage announcements & programs</p>
      <div class="stat-number"><?= $news ?></div>
    </div>

    <div class="tile" onclick="location.href='manage-gallery.php'">
      <h3>🖼 Gallery</h3>
      <p>Manage school photos</p>
      <div class="stat-number"><?= $gallery ?></div>
    </div>

    <div class="tile" onclick="location.href='manage-academics.php'">
      <h3>📚 Academics</h3>
      <p>Manage Levels, Grades & Books</p>
      <div class="stat-number"><?= $academics ?></div>
    </div>

    <div class="tile" onclick="location.href='manage-faculty.php'">
      <h3>👨‍🏫 Faculty</h3>
      <p>Manage teachers & staff</p>
      <div class="stat-number"><?= $faculty ?></div>
    </div>

    <div class="tile" onclick="location.href='manage-principal.php'">
      <h3>👨‍🏫 Principal</h3>
      <p>Manage Principal’s photo & message</p>
      <div class="stat-number">
        <?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_principal"))['total']; ?>
      </div>
    </div>

    <div class="tile" onclick="location.href='manage-trustee.php'">
      <h3>👔 Trustee</h3>
      <p>Manage Trustee’s photo & message</p>
      <div class="stat-number">
        <?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_trustee"))['total']; ?>
      </div>
    </div>

    <div class="tile" onclick="location.href='manage-leadership.php'">
      <h3>👥 Leadership Team</h3>
      <p>Manage leadership members</p>
      <div class="stat-number">
        <?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_leadership_team"))['total']; ?>
      </div>
    </div>

    <div class="tile" onclick="location.href='manage-journey.php'">
      <h3>🕰 Journey Timeline</h3>
      <p>School events & history</p>
      <div class="stat-number">
        <?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_journey"))['total']; ?>
      </div>
    </div>

    <div class="tile" onclick="location.href='manage-mvv.php'">
      <h3>🎯 Mission, Vision & Values</h3>
      <p>Edit school purpose & values</p>
      <div class="stat-number">
        <?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM about_mvv"))['total']; ?>
      </div>
    </div>

    <div class="tile" onclick="location.href='enquiry-list.php'">
      <h3>📨 Admission Enquiries</h3>
      <p>View submitted admission forms</p>
      <div class="stat-number">
        <?php 
          $enq = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT COUNT(*) AS total FROM admission_enquiries")
          )['total']; 
          echo $enq;
        ?>
      </div>
    </div>

  </div>

</div>

</body>
</html>