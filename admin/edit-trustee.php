<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

if (!isset($_GET['id'])) {
  header("Location: manage-trustee.php");
  exit();
}

$id = (int) $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM about_trustee WHERE id = $id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
  header("Location: manage-trustee.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name        = mysqli_real_escape_string($conn, $_POST['name']);
  $designation = mysqli_real_escape_string($conn, $_POST['designation']);
  $message     = mysqli_real_escape_string($conn, $_POST['message']);

  $image = $data['image'];

  if (!empty($_FILES["image"]["name"])) {
    $imageName = time() . "-" . basename($_FILES["image"]["name"]);
    $target = "../assets/" . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
      if (!empty($data['image']) && file_exists("../assets/" . $data['image'])) {
        unlink("../assets/" . $data['image']);
      }
      $image = $imageName;
    }
  }

  mysqli_query($conn, "
    UPDATE about_trustee
    SET name='$name', designation='$designation', message='$message', image='$image'
    WHERE id=$id
  ");

  header("Location: manage-trustee.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Trustee</title>
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
    .preview-img {
      margin-top: 10px;
      width: 120px;
      border-radius: 8px;
      display: block;
    }
  </style>
</head>
<body>

<a href="manage-trustee.php" class="back-btn" style="margin: 16px; display:inline-block;">← Back to Trustee List</a>

<div class="container">
  <h2>Edit Trustee</h2>

  <form method="POST" enctype="multipart/form-data">
    <label>Trustee Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" required>

    <label>Designation</label>
    <input type="text" name="designation" value="<?php echo htmlspecialchars($data['designation']); ?>" required>

    <label>Message</label>
    <textarea name="message" required><?php echo htmlspecialchars($data['message']); ?></textarea>

    <label>Current Photo</label>
    <?php if (!empty($data['image'])) { ?>
      <img src="../assets/<?php echo $data['image']; ?>" class="preview-img" alt="Current Trustee Photo">
    <?php } ?>

    <label>Change Photo</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" class="btn-primary">Update</button>
  </form>
</div>

</body>
</html>