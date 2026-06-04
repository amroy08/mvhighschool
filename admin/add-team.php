<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }
include "../db.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){

  $name = $_POST['name'];
  $role = $_POST['role'];
  $description = $_POST['description'];

  $image = time()."-".basename($_FILES["image"]["name"]);
  move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/".$image);

  mysqli_query($conn, "INSERT INTO about_team (name, role, description, image) 
  VALUES ('$name','$role','$description','$image')");

  header("Location: manage-team.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Team Member</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>

<body>
<div class="container" style="margin-top:40px;">
<h2>Add Team Member</h2>

<form method="POST" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name" required>

<label>Role</label>
<input type="text" name="role" required>

<label>Description</label>
<textarea name="description" required></textarea>

<label>Image</label>
<input type="file" name="image" required>

<button class="btn primary" style="margin-top:15px;">Save</button>

</form>
</div>
</body>
</html>
