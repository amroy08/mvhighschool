<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }
include "../db.php";

$team = mysqli_query($conn, "SELECT * FROM about_team ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Team | Admin</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container" style="margin-top:40px;">

<h2>Manage Team Members</h2>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<a href="add-team.php" class="btn primary" style="margin-bottom:15px;">+ Add Member</a>

<table class="table">
<thead>
<tr>
  <th>Image</th>
  <th>Name</th>
  <th>Role</th>
  <th>Description</th>
  <th>Actions</th>
</tr>
</thead>

<tbody>
<?php while($t = mysqli_fetch_assoc($team)): ?>
<tr>
  <td><img src="../assets/<?= $t['image'] ?>" width="60" style="border-radius:8px;"></td>
  <td><?= $t['name'] ?></td>
  <td><?= $t['role'] ?></td>
  <td><?= substr($t['description'],0,40) ?>...</td>
  <td>
    <a href="edit-team.php?id=<?= $t['id'] ?>" class="btn">Edit</a>
    <a href="delete-team.php?id=<?= $t['id'] ?>" class="btn" style="background:#dc2626;color:#fff;" onclick="return confirm('Delete this member?')">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</tbody>

</table>

</div>
</body>
</html>
