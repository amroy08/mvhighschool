<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
include "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;

    // Image upload
    $image = "uploads/" . time() . "-" . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../" . $image);

    mysqli_query($conn,
        "INSERT INTO accomplishments (title, slug, category, image, description, is_featured)
         VALUES ('$title', '$slug', '$category', '$image', '$description', '$is_featured')"
    );

    header("Location: manage-accomplishments.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Accomplishment</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">
<h2>Add Accomplishment</h2>

<form method="POST" enctype="multipart/form-data">

<label>Title</label>
<input type="text" name="title" required>

<label>Slug (example: academic-excellence)</label>
<input type="text" name="slug" required>

<label>Category</label>
<select name="category" required>
  <option>Academics</option>
  <option>Sports</option>
  <option>Arts</option>
  <option>STEM</option>
  <option>Community</option>
  <option>Teachers</option>
</select>

<label>Image</label>
<input type="file" name="image" accept="image/*" onchange="previewImage(event)" required>

<img id="preview" style="display:none; width:200px; margin-top:10px; border-radius:12px;">

<script>
function previewImage(event){
  let img=document.getElementById("preview");
  img.src=URL.createObjectURL(event.target.files[0]);
  img.style.display="block";
}
</script>

<label>Description</label>
<textarea name="description" rows="6" required></textarea>

<label style="margin-top:10px;">
  <input type="checkbox" name="is_featured"> Feature This Achievement of the Month
</label>

<button class="btn primary" style="margin-top:20px;">Save</button>

</form>
</div>

</body>
</html>
