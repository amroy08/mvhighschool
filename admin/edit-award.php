<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }
include "../db.php";

$id = $_GET['id'];
$a = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM about_awards WHERE id=$id"));

if($_SERVER["REQUEST_METHOD"]=="POST"){

  $year = $_POST['year'];
  $title = $_POST['title'];
  $description = $_POST['description'];

  $image = $a['image'];
  if(!empty($_FILES["image"]["name"])){
    $image = time()."-".$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/".$image);
  }

  mysqli_query($conn,
    "UPDATE about_awards SET year='$year', title='$title', 
    description='$description', image='$image' WHERE id=$id"
  );

  header("Location: manage-awards.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Award</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container" style="margin-top:40px;">
<h2>Edit Award</h2>

<form method="POST" enctype="multipart/form-data">

<label>Year</label>
<input type="text" name="year" value="<?= $a['year'] ?>" required>

<label>Title</label>
<input type="text" name="title" value="<?= $a['title'] ?>" required>

<label>Description</label>
<textarea name="description" required><?= $a['description'] ?></textarea>

<label>Image</label><br>
<img src="../assets/<?= $a['image'] ?>" width="120" style="border-radius:10px;margin-bottom:10px;">
<input type="file" name="image">

<button class="btn primary" style="margin-top:15px;">Update</button>

</form>
</div>
</body>
</html>
