<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }
include "../db.php";

$timeline = mysqli_query($conn,"SELECT * FROM about_timeline ORDER BY year ASC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Timeline</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>
<div class="container" style="margin-top:40px;">

<h2>Manage Historical Timeline</h2>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<a href="add-timeline.php" class="btn primary" style="margin-bottom:15px;">+ Add Timeline Entry</a>

<table class="table">
<thead>
<tr>
  <th>Year</th>
  <th>Title</th>
  <th>Description</th>
  <th>Actions</th>
</tr>
</thead>

<tbody>
<?php while($tl = mysqli_fetch_assoc($timeline)): ?>
<tr>
  <td><?= $tl['year'] ?></td>
  <td><?= $tl['title'] ?></td>
  <td><?= substr($tl['description'],0,40) ?>...</td>
  <td>
    <a href="edit-timeline.php?id=<?= $tl['id'] ?>" class="btn">Edit</a>
    <a href="delete-timeline.php?id=<?= $tl['id'] ?>" class="btn" style="background:#dc2626;color:white;" onclick="return confirm('Delete this entry?')">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</tbody>

</table>

</div>
</body>
</html>
