<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

$id = (int) $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM about_leadership_team WHERE id=$id");
$member = mysqli_fetch_assoc($res);

if (!$member) {
  header("Location: manage-leadership.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $designation = mysqli_real_escape_string($conn, $_POST['designation']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $image_sql = "";
  if (!empty($_FILES["image"]["name"])) {
    $imageName = time() . "-" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/" . $imageName);
    $image_sql = ", image='$imageName'";
  }

  mysqli_query($conn,
    "UPDATE about_leadership_team 
     SET name='$name', designation='$designation', message='$message' $image_sql
     WHERE id=$id"
  );

  header("Location: manage-leadership.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Leadership Member</title>
  <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .container { max-width: 700px; margin: 40px auto; background:#fff; padding:20px; border-radius:8px; }
    label { font-weight: 600; margin-top: 10px; display:block; }
    input, textarea { width:100%; padding:8px; margin-top:5px; border-radius:4px; border:1px solid #ccc; }
    textarea { height:120px; }
    img.preview { max-width:120px; margin-top:10px; border-radius:6px; }
    .btn-primary { background:#007bff; color:white; padding:10px 16px; border:none; margin-top:16px; cursor:pointer; border-radius:4px; }
  </style>
</head>
<body>

<a href="manage-leadership.php" style="margin: 16px; display:inline-block;">← Back</a>

<div class="container">
  <h2>Edit Leadership Member</h2>

  <form method="POST" enctype="multipart/form-data">

    <label>Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required>

    <label>Designation</label>
    <input type="text" name="designation" value="<?php echo htmlspecialchars($member['designation']); ?>" required>

    <label>Message</label>
    <textarea name="message" required><?php echo htmlspecialchars($member['message']); ?></textarea>

    <label>Current Photo</label><br>
    <img src="../assets/<?php echo $member['image']; ?>" class="preview">

    <label>Replace Photo (optional)</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" class="btn-primary">Update</button>
  </form>
</div>

</body>
</html>
