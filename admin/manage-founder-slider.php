<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }

include "../db.php";

$slides = mysqli_query($conn, "SELECT * FROM about_founder_slider ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Founder Slider</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container" style="margin-top:40px;">
<h2>Founder Message Slider</h2>
<a href="add-founder-slide.php" class="btn primary" style="margin-bottom:15px;">+ Add Slide</a>

<table class="table">
<thead>
<tr>
  <th>Image</th>
  <th>Title</th>
  <th>Message</th>
  <th>Actions</th>
</tr>
</thead>

<tbody>
<?php while($s = mysqli_fetch_assoc($slides)): ?>
<tr>
  <td><img src="../assets/<?= $s['image'] ?>" width="60"></td>
  <td><?= $s['title'] ?></td>
  <td><?= substr($s['message'],0,40) ?>...</td>
  <td>
    <a href="edit-founder-slide.php?id=<?= $s['id'] ?>" class="btn">Edit</a>
    <a href="delete-founder-slide.php?id=<?= $s['id'] ?>" class="btn" style="background:#dc2626;color:white;" onclick="return confirm('Delete this slide?')">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</tbody>

</table>

</div>
</body>
</html>
