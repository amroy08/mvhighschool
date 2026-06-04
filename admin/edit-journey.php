<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}

include "../db.php";

$id = (int) $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM about_journey WHERE id=$id");
$journey = mysqli_fetch_assoc($res);

if (!$journey) {
  header("Location: manage-journey.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $year = mysqli_real_escape_string($conn, $_POST['year']);
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);

  $image_sql = "";
  if (!empty($_FILES["image"]["name"])) {
    $imageName = time() . "-" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/" . $imageName);
    $image_sql = ", image='$imageName'";
  }

  mysqli_query($conn,
    "UPDATE about_journey
     SET year='$year', title='$title', description='$description' $image_sql
     WHERE id=$id"
  );

  header("Location: manage-journey.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Timeline Event</title>
  <link rel="stylesheet" href="../styles.css">

  <style>
    .container { max-width:700px; margin:40px auto; background:white; padding:20px; border-radius:8px; }
    label { display:block; font-weight:600; margin-top:10px; }
    input, textarea { width:100%; padding:8px; margin-top:5px; border-radius:4px; border:1px solid #ccc; }
    textarea { height:120px; }
    img.preview { max-width:120px; border-radius:6px; margin-top:10px; }
    .btn-primary { background:#007bff; padding:10px 18px; border:none; color:white; cursor:pointer; border-radius:4px; margin-top:15px; }
  </style>
</head>
<body>

<a href="manage-journey.php" style="margin: 16px;">← Back</a>

<div class="container">
  <h2>Edit Timeline Event</h2>
  <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

  <form method="POST" enctype="multipart/form-data">

    <label>Year</label>
    <input type="text" name="year" value="<?php echo htmlspecialchars($journey['year']); ?>" required>

    <label>Title</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($journey['title']); ?>" required>

    <label>Description</label>
    <textarea name="description" required><?php echo htmlspecialchars($journey['description']); ?></textarea>

    <label>Current Photo</label><br>
    <?php if ($journey['image']) { ?>
      <img src="../assets/<?php echo $journey['image']; ?>" class="preview">
    <?php } else { echo "No Image"; } ?>

    <label>Replace Photo (optional)</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" class="btn-primary">Update</button>
  </form>

</div>

</body>
</html>
