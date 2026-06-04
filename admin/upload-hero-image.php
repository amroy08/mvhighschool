<?php
include "../db.php";
session_start();

if(!isset($_SESSION['admin_logged_in'])) exit();

if($_FILES['image']['name'] != "") {
    
    $folder = "../assets/hero/";
    if(!is_dir($folder)) mkdir($folder, 0777, true);

    $filename = time() . "_" . $_FILES['image']['name'];
    $target = $folder . $filename;

    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $image_path = "assets/hero/" . $filename;

    mysqli_query($conn, "INSERT INTO home_hero_images (image) VALUES ('$image_path')");
}

header("Location: manage-hero-images.php");
exit();
?>
