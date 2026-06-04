<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $year = mysqli_real_escape_string($conn, $_POST['year']);
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);

  $image = null;
  if (!empty($_FILES["image"]["name"])) {
    $imageName = time() . "-" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/" . $imageName);
    $image = $imageName;
  }

  mysqli_query($conn,
    "INSERT INTO about_journey (year, title, description, image)
     VALUES ('$year','$title','$description','$image')"
  );

  header("Location: manage-journey.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Timeline Event</title>
  <link rel="stylesheet" href="../styles.css">

  <style>
    .container {
      max-width: 700px;
      margin: 40px auto;
      background:white; padding:20px;
      border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.08);
    }
    label { font-weight:600; margin-top:10px; display:block; }
    input, textarea {
      width:100%; padding:8px; margin-top:5px;
      border-radius:4px; border:1px solid #ccc;
    }
    textarea { height:120px; }
    .btn-primary {
      background:#007bff; color:white;
      padding:10px 18px; border:none;
      border-radius:4px; margin-top:15px;
      cursor:pointer;
    }
  </style>
</head>
<body>

<a href="manage-journey.php" style="margin: 16px;">← Back</a>

<div class="container">
  <h2>Add Timeline Event</h2>

  <form method="POST" enctype="multipart/form-data">

    <label>Year</label>
    <input type="text" name="year" placeholder="e.g. 1998, 2005, 2020" required>

    <label>Title</label>
    <input type="text" name="title" required>

    <label>Description</label>
    <textarea name="description" required></textarea>

    <label>Photo (optional)</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" class="btn-primary">Save</button>
  </form>

</div>

</body>
</html>
