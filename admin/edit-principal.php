<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

if (!isset($_GET['id'])) {
  header("Location: manage-principal.php");
  exit();
}

$id = (int) $_GET['id'];

// Fetch existing principal
$res = mysqli_query($conn, "SELECT * FROM about_principal WHERE id=$id");
$principal = mysqli_fetch_assoc($res);

if (!$principal) {
  header("Location: manage-principal.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name        = mysqli_real_escape_string($conn, $_POST['name']);
  $designation = mysqli_real_escape_string($conn, $_POST['designation']);
  $message     = mysqli_real_escape_string($conn, $_POST['message']);

  $image_sql = "";
  if (!empty($_FILES["image"]["name"])) {
    $imageName = time() . "-" . basename($_FILES["image"]["name"]);
    $target = "../assets/" . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
      $image_sql = ", image='$imageName'";
    }
  }

  mysqli_query($conn,
    "UPDATE about_principal 
     SET name='$name', designation='$designation', message='$message' $image_sql
     WHERE id=$id"
  );

  header("Location: manage-principal.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Principal</title>
  <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
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
    img.principal-photo {
      max-width: 120px;
      border-radius: 6px;
      margin-top: 8px;
    }
  </style>
</head>
<body>

<a href="manage-principal.php" class="back-btn" style="margin: 16px; display:inline-block;">← Back to Principal List</a>

<div class="container">
  <h2>Edit Principal Message</h2>

  <form method="POST" enctype="multipart/form-data">
    <label>Principal Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($principal['name']); ?>" required>

    <label>Designation</label>
    <input type="text" name="designation" value="<?php echo htmlspecialchars($principal['designation']); ?>" required>

    <label>Message</label>
    <textarea name="message" required><?php echo htmlspecialchars($principal['message']); ?></textarea>

    <label>Current Photo</label><br>
    <?php if (!empty($principal['image'])) { ?>
      <img src="../assets/<?php echo htmlspecialchars($principal['image']); ?>" 
           alt="Principal Photo" 
           class="principal-photo">
    <?php } else { ?>
      No image uploaded.
    <?php } ?>

    <label style="margin-top: 12px;">Change Photo (optional)</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" class="btn-primary">Update</button>
  </form>
</div>

</body>
</html>
