<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }
include "../db.php";

$awards = mysqli_query($conn,"SELECT * FROM about_awards ORDER BY year DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Awards</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container" style="margin-top:40px;">
<h2>Manage Awards</h2>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<a href="add-award.php" class="btn primary" style="margin-bottom:15px;">+ Add Award</a>

<table class="table">
<thead>
<tr>
  <th>Image</th>
  <th>Year</th>
  <th>Title</th>
  <th>Description</th>
  <th>Actions</th>
</tr>
</thead>

<tbody>
<?php while($a = mysqli_fetch_assoc($awards)): ?>
<tr>
  <td><img src="../assets/<?= $a['image'] ?>" width="60"></td>
  <td><?= $a['year'] ?></td>
  <td><?= $a['title'] ?></td>
  <td><?= substr($a['description'],0,40) ?>...</td>
  <td>
    <a href="edit-award.php?id=<?= $a['id'] ?>" class="btn">Edit</a>
    <a href="delete-award.php?id=<?= $a['id'] ?>" class="btn" style="background:#dc2626;color:white;" onclick="return confirm('Delete this award?')">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</tbody>

</table>

</div>

</body>
</html>
