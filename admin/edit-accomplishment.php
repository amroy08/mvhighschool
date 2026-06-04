<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
include "../db.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM accomplishments WHERE id=$id");
$acc = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;

    // If new image uploaded
    if ($_FILES['image']['name']) {
        $image = "uploads/" . time() . "-" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../" . $image);
    } else {
        $image = $acc['image'];
    }

    mysqli_query($conn,
        "UPDATE accomplishments SET
            title='$title',
            slug='$slug',
            category='$category',
            image='$image',
            description='$description',
            is_featured='$is_featured'
        WHERE id=$id"
    );

    header("Location: manage-accomplishments.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Accomplishment</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">
<h2>Edit Accomplishment</h2>

<form method="POST" enctype="multipart/form-data">

<label>Title</label>
<input type="text" name="title" value="<?= $acc['title'] ?>" required>

<label>Slug</label>
<input type="text" name="slug" value="<?= $acc['slug'] ?>" required>

<label>Category</label>
<select name="category" required>
  <option <?= $acc['category']=="Academics"?"selected":"" ?>>Academics</option>
  <option <?= $acc['category']=="Sports"?"selected":"" ?>>Sports</option>
  <option <?= $acc['category']=="Arts"?"selected":"" ?>>Arts</option>
  <option <?= $acc['category']=="STEM"?"selected":"" ?>>STEM</option>
  <option <?= $acc['category']=="Community"?"selected":"" ?>>Community</option>
  <option <?= $acc['category']=="Teachers"?"selected":"" ?>>Teachers</option>
</select>

<label>Image</label>
<input type="file" name="image" accept="image/*" onchange="previewImage(event)">
<img id="preview" src="../<?= $acc['image'] ?>" 
     style="width:200px; margin-top:10px; border-radius:12px;">

<script>
function previewImage(event){
  document.getElementById("preview").src = URL.createObjectURL(event.target.files[0]);
}
</script>

<label>Description</label>
<textarea name="description" rows="6" required><?= $acc['description'] ?></textarea>

<label>
  <input type="checkbox" name="is_featured" <?= $acc['is_featured'] ? "checked" : "" ?>>
  Featured of the Month
</label>

<button class="btn primary" style="margin-top:20px;">Update</button>

</form>
</div>

</body>
</html>
