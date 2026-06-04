<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name        = mysqli_real_escape_string($conn, $_POST['name']);
  $designation = mysqli_real_escape_string($conn, $_POST['designation']);
  $message     = mysqli_real_escape_string($conn, $_POST['message']);

  $image = null;
  if (!empty($_FILES["image"]["name"])) {
    $imageName = time() . "-" . basename($_FILES["image"]["name"]);
    $target = "../assets/" . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
      $image = $imageName;
    }
  }

  mysqli_query($conn,
    "INSERT INTO about_principal (name, designation, message, image)
     VALUES ('$name','$designation','$message','$image')"
  );

  header("Location: manage-principal.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Principal</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .container {
      max-width: 700px;
      margin: 40px auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    label { display: block; margin-top: 10px; font-weight: 600; }
    input[type="text"], textarea {
      width: 100%;
      padding: 8px;
      margin-top: 4px;
      border-radius: 4px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    textarea {
      min-height: 140px;
      resize: vertical;
    }
    .btn-primary {
      margin-top: 16px;
      padding: 8px 16px;
      border-radius: 4px;
      border: none;
      background: #007bff;
      color: #fff;
      cursor: pointer;
      font-size: 14px;
    }
  </style>
</head>
<body>

<a href="manage-principal.php" class="back-btn" style="margin: 16px; display:inline-block;">← Back to Principal List</a>

<div class="container">
  <h2>Add Principal Message</h2>

  <form method="POST" enctype="multipart/form-data">
    <label>Principal Name</label>
    <input type="text" name="name" required>

    <label>Designation</label>
    <input type="text" name="designation" value="Principal" required>

    <label>Message</label>
    <textarea name="message" required></textarea>

    <label>Photo</label>
    <input type="file" name="image" accept="image/*" required>

    <button type="submit" class="btn-primary">Save</button>
  </form>
</div>

</body>
</html>
