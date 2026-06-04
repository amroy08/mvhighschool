<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit();
}

include "../db.php";

// Fetch all hero images
$images = mysqli_query($conn, "SELECT * FROM home_hero_images ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Hero Slideshow</title>
<link rel="stylesheet" href="../styles.css">

<style>
.card {
  background:#fff; padding:20px; border-radius:14px;
  box-shadow:0 5px 15px rgba(0,0,0,0.08);
  max-width:900px; margin:auto; margin-top:30px;
}
img {
  width:200px; border-radius:10px; margin:10px;
}
.delete-btn {
  background:#dc2626;color:#fff;border:none;padding:8px 12px;
  border-radius:6px;cursor:pointer;
}
</style>
</head>
<body>

<div class="container">

<h2>Manage Hero Slideshow Images</h2>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>


<div class="card">
  <form action="upload-hero-image.php" method="POST" enctype="multipart/form-data">
      <label>Upload New Hero Image</label>
      <input type="file" name="image" required>
      <br><br>
      <button class="btn primary">Upload</button>
  </form>
</div>

<div class="card">
  <h3>Uploaded Photos</h3>

  <?php while($row = mysqli_fetch_assoc($images)) { ?>
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
        <img src="../<?= $row['image'] ?>">
        <form action="delete-hero-image.php" method="POST">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button class="delete-btn">Delete</button>
        </form>
    </div>
  <?php } ?>
</div>

</div>

</body>
</html>
