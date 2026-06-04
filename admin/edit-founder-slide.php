<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }

include "../db.php";

$id = $_GET['id'];
$s = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM about_founder_slider WHERE id=$id"));

if($_SERVER["REQUEST_METHOD"]=="POST"){

  $title = $_POST['title'];
  $message = $_POST['message'];

  $image = $s['image'];
  if(!empty($_FILES["image"]["name"])){
    $image = time()."-".$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/".$image);
  }

  mysqli_query($conn,
    "UPDATE about_founder_slider SET 
    title='$title', message='$message', image='$image'
    WHERE id=$id"
  );

  header("Location: manage-founder-slider.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Slide</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>
<div class="container" style="margin-top:40px;">

<h2>Edit Slide</h2>

<form method="POST" enctype="multipart/form-data">

<label>Title</label>
<input type="text" name="title" value="<?= $s['title'] ?>" required>

<label>Message</label>
<textarea name="message" required><?= $s['message'] ?></textarea>

<label>Image</label><br>
<img src="../assets/<?= $s['image'] ?>" width="120" style="border-radius:10px;margin-bottom:10px;">
<input type="file" name="image">

<button class="btn primary" style="margin-top:15px;">Update</button>

</form>
</div>
</body>
</html>
