<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }

include "../db.php";
$sections = mysqli_query($conn, "SELECT * FROM about_sections");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage About | Admin</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
<style>
.section-box {
  background:#fff; padding:18px; border-radius:14px; box-shadow:var(--shadow); margin-bottom:20px;
}
</style>
</head>

<body>
<div class="container" style="margin-top:35px;">
<h2>Manage About Page</h2>

<?php while ($s = mysqli_fetch_assoc($sections)): ?>
<div class="section-box">
  <h3><?= ucfirst(str_replace("_", " ", $s['section'])) ?></h3>
  <p><strong>Name:</strong> <?= $s['name'] ?></p>
  <p><strong>Description:</strong> <?= substr($s['description'], 0, 80) ?>...</p>

  <a href="edit-about.php?id=<?= $s['id'] ?>" class="btn primary">Edit</a>
</div>
<?php endwhile; ?>

</div>
</body>
</html>
