<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }

include "../db.php";

$id = intval($_GET['id']);

// 1. Get album cover
$album = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT cover_image FROM gallery_albums WHERE id=$id"
));

if ($album) {
    $cover = "../" . $album['cover_image'];
    if (file_exists($cover)) unlink($cover);
}

// 2. Get all photos
$photos = mysqli_query($conn,
    "SELECT photo_path FROM gallery_photos WHERE album_id=$id"
);

while ($p = mysqli_fetch_assoc($photos)) {
    $file = "../" . $p['photo_path'];
    if (file_exists($file)) unlink($file);
}

// 3. Delete from database
mysqli_query($conn, "DELETE FROM gallery_photos WHERE album_id=$id");
mysqli_query($conn, "DELETE FROM gallery_albums WHERE id=$id");

// 4. Redirect
header("Location: manage-gallery.php");
exit();
?>
