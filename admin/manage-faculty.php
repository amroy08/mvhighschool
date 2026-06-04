

<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
include "../db.php";

$faculty = mysqli_query($conn, "SELECT * FROM faculty ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Faculty | Admin</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container" style="margin-top:40px;">
<h2>Manage Staff</h2>

<a href="add-faculty.php" class="btn primary">+ Add Staff</a>

<table class="table" style="margin-top:20px;">
<thead>
<tr>
  <th>Photo</th>
  <th>Name</th>
  <th>Staff Type</th>
  <th>Designation</th>
  <th>Actions</th>
</tr>
</thead>

<tbody>
<?php while ($row = mysqli_fetch_assoc($faculty)): ?>
<tr>
  <td>
    <?php if(!empty($row['image'])): ?>
      <img src="../<?= $row['image'] ?>" width="70" style="border-radius:8px;">
    <?php else: ?>
      <span class="muted">No Photo</span>
    <?php endif; ?>
  </td>
  <td><?= $row['name'] ?></td>
  <td><strong><?= $row['staff_type'] ?></strong></td>
  <td><?= $row['designation'] ?></td>
  <td>
    <a href="edit-faculty.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
    <a href="delete-faculty.php?id=<?= $row['id'] ?>"
       onclick="return confirm('Delete this staff member?')"
       class="btn" style="background:#dc2626;color:white;">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</tbody>

</table>

</div>

</body>
</html>
