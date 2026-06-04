<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }

include "../db.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){

  $year = $_POST['year'];
  $title = $_POST['title'];
  $description = $_POST['description'];

  $image = "";
  if(!empty($_FILES["image"]["name"])){
    $image = time()."-".$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/".$image);
  }

  mysqli_query($conn,"INSERT INTO about_awards (year,title,description,image)
  VALUES ('$year','$title','$description','$image')");

  header("Location: manage-awards.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Award</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container" style="margin-top:40px;">
    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
<h2>Add Award</h2>

<form method="POST" enctype="multipart/form-data">

<label>Year</label>
<input type="text" name="year" required>

<label>Title</label>
<input type="text" name="title" required>

<label>Description</label>
<textarea name="description" required></textarea>

<label>Image (optional)</label>
<input type="file" name="image">

<button class="btn primary" style="margin-top:15px;">Save</button>

</form>
</div>
</body>
</html>
