<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }

include "../db.php";
$id = $_GET['id'];
$t = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM about_team WHERE id=$id"));

if($_SERVER["REQUEST_METHOD"]=="POST"){

  $name = $_POST['name'];
  $role = $_POST['role'];
  $description = $_POST['description'];

  $image = $t['image'];

  if(!empty($_FILES["image"]["name"])){
    $image = time()."-".$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/".$image);
  }

  mysqli_query($conn,
    "UPDATE about_team SET name='$name', role='$role', description='$description', image='$image' WHERE id=$id"
  );

  header("Location: manage-team.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Team</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>
<div class="container" style="margin-top:40px;">
<h2>Edit Team Member</h2>

<form method="POST" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name" value="<?= $t['name'] ?>" required>

<label>Role</label>
<input type="text" name="role" value="<?= $t['role'] ?>" required>

<label>Description</label>
<textarea name="description" required><?= $t['description'] ?></textarea>

<label>Image</label><br>
<img src="../assets/<?= $t['image'] ?>" width="120" style="border-radius:10px;margin-bottom:10px;">
<input type="file" name="image">

<button class="btn primary" style="margin-top:15px;">Update</button>

</form>
</div>
</body>
</html>
