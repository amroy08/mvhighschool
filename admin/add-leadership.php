<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $designation = mysqli_real_escape_string($conn, $_POST['designation']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $image = null;
  if (!empty($_FILES["image"]["name"])) {
    $imageName = time() . "-" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/" . $imageName);
    $image = $imageName;
  }

  mysqli_query($conn,
    "INSERT INTO about_leadership_team (name, designation, message, image)
     VALUES ('$name','$designation','$message','$image')"
  );

  header("Location: manage-leadership.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Leadership Member</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .container {
      max-width: 700px;
      margin: 40px auto;
      padding: 20px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    label { font-weight: 600; margin-top: 10px; display: block; }
    input, textarea {
      width: 100%; padding: 8px; margin-top: 5px; border-radius: 4px; border: 1px solid #ccc;
    }
    textarea { height: 120px; }
    .btn-primary {
      background: #007bff; color: #fff; padding: 10px 16px; border:none; margin-top:16px;
      cursor:pointer; border-radius:4px;
    }
  </style>
</head>
<body>

<a href="manage-leadership.php" style="margin: 16px; display:inline-block;">← Back</a>

<div class="container">
  <h2>Add Leadership Member</h2>

  <form method="POST" enctype="multipart/form-data">

    <label>Name</label>
    <input type="text" name="name" required>

    <label>Designation</label>
    <input type="text" name="designation" required>

    <label>Message</label>
    <textarea name="message" required></textarea>

    <label>Photo</label>
    <input type="file" name="image" accept="image/*" required>

    <button type="submit" class="btn-primary">Save</button>
  </form>
</div>

</body>
</html>
