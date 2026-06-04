<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }

include "../db.php";

$id = intval($_GET['id']);
$album = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM gallery_albums WHERE id=$id"));

if (!$album) die("Album not found");

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $name = $_POST['album_name'];
    $slug = $_POST['slug'];

    // If new cover image selected
    if (!empty($_FILES['cover']['name'])) {

        // Remove old
        $old = "../" . $album['cover_image'];
        if (file_exists($old)) unlink($old);

        // Save new
        $cover = "assets/gallery/" . time() . "-" . $_FILES['cover']['name'];
        move_uploaded_file($_FILES['cover']['tmp_name'], "../" . $cover);

        mysqli_query($conn,
            "UPDATE gallery_albums 
             SET album_name='$name', slug='$slug', cover_image='$cover'
             WHERE id=$id"
        );
    } else {
        mysqli_query($conn,
            "UPDATE gallery_albums 
             SET album_name='$name', slug='$slug'
             WHERE id=$id"
        );
    }

    header("Location: manage-gallery.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Album | Admin</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">
    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
<h2>Edit Album</h2>

<form method="POST" enctype="multipart/form-data">

<label>Album Name</label>
<input type="text" name="album_name" value="<?= $album['album_name'] ?>" required>

<label>Slug</label>
<input type="text" name="slug" value="<?= $album['slug'] ?>" required>

<label>Current Cover</label><br>
<img src="../<?= $album['cover_image'] ?>" width="120" style="border-radius:6px;margin:10px 0;"><br>

<label>Upload New Cover (optional)</label>
<input type="file" name="cover" accept="image/*">

<button class="btn primary">Update</button>
</form>

</div>
</body>
</html>
