<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
include "../db.php";

$id = intval($_GET['id']);
$album_id = intval($_GET['album']);

$photo = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT photo_path FROM gallery_photos WHERE id=$id"
));

if ($photo) {
    $file = "../" . $photo['photo_path'];
    if (file_exists($file)) unlink($file);

    mysqli_query($conn, "DELETE FROM gallery_photos WHERE id=$id");
}

header("Location: upload-photos.php?id=$album_id");
exit();
?>
