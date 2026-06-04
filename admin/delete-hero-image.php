<?php
include "../db.php";
session_start();

$id = $_POST['id'];

mysqli_query($conn, "DELETE FROM home_hero_images WHERE id='$id'");

header("Location: manage-hero-images.php");
exit();
?>
