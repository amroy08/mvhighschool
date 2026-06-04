<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }

include "../db.php";

$list = mysqli_query($conn, "SELECT * FROM choose_us ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Why Choose Us</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container">
<h2>Manage “Why Choose Us”</h2>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>


<a href="add-choose-us.php" class="btn primary" style="margin-bottom:20px;">+ Add New Point</a>

<table class="table">
<tr>
  <th>Icon</th>
  <th>Title</th>
  <th>Description</th>
  <th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($list)){ ?>
<tr>
  <td><?= $row['icon'] ?></td>
  <td><?= $row['title'] ?></td>
  <td><?= $row['description'] ?></td>
  <td>
    <a href="edit-choose-us.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
    <a href="delete-choose-us.php?id=<?= $row['id'] ?>" class="btn danger" onclick="return confirm('Delete?')">Delete</a>
  </td>
</tr>
<?php } ?>

</table>

</div>
</body>
</html>
