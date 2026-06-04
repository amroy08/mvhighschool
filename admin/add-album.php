<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit(); 
}

include "../db.php";

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $name = $_POST['album_name'];
    $slug = $_POST['slug'];

    // NEW CORRECT PATH
    $filename = time() . "-" . basename($_FILES['cover']['name']);
    $cover = "assets/gallery/" . $filename;

    // Move file to correct location
    move_uploaded_file($_FILES['cover']['tmp_name'], "../assets/gallery/" . $filename);

    // Save correct path to DB
    mysqli_query($conn,
        "INSERT INTO gallery_albums (album_name, slug, cover_image)
         VALUES ('$name', '$slug', '$cover')"
    );

    header("Location: manage-gallery.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Album | Admin</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">
<h2>Add New Album</h2>

<form method="POST" enctype="multipart/form-data">

<label>Album Name</label>
<input type="text" name="album_name" required>

<label>Slug (cricket, yoga, carrom)</label>
<input type="text" name="slug" required>

<label>Cover Image</label>
<input type="file" name="cover" accept="image/*" required>

<button class="btn primary">Save</button>
</form>

</div>
</body>
</html>
