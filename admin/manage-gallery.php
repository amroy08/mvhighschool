<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit(); 
}

include "../db.php";

// Fetch albums
$albums = mysqli_query($conn, "SELECT * FROM gallery_albums ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Gallery | Admin</title>
<link rel="stylesheet" href="../styles.css">

<style>
.table img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    background: #f1f5f9;
}
.btn-danger {
    background:#dc2626;
    color:white;
}
</style>

</head>
<body>

<div class="container" style="margin-top:40px;">
<h2>Manage Gallery Albums</h2>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>


<a href="add-album.php" class="btn primary">+ Add Album</a>

<table class="table" style="margin-top:20px;">
  <thead>
    <tr>
      <th>Cover</th>
      <th>Album Name</th>
      <th>Actions</th>
    </tr>
  </thead>

  <tbody>
  <?php while($row = mysqli_fetch_assoc($albums)): ?>

    <?php 
      // FIXED: full correct path
      $coverPath = "../" . $row['cover_image'];

      // fallback if file missing
      if (!file_exists($coverPath)) {
          $coverPath = "../assets/no-image.png"; 
      }
    ?>

    <tr>
      <td>
        <img src="<?= $coverPath ?>">
      </td>

      <td><?= $row['album_name'] ?></td>

      <td>
        <a class="btn" href="upload-photos.php?id=<?= $row['id'] ?>">Upload Photos</a>
        <a class="btn" href="edit-album.php?id=<?= $row['id'] ?>">Edit</a>

        <a class="btn btn-danger"
           href="delete-album.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Delete this album and ALL photos?')">
           Delete
        </a>
      </td>
    </tr>

  <?php endwhile; ?>
  </tbody>

</table>

</div>
</body>
</html>
