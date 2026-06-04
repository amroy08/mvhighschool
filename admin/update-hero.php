<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php");
    exit();
}

include "../db.php";

$title = $_POST['title'];
$subtitle = $_POST['subtitle'];

$image_query = "";

if (!empty($_FILES['image']['name'])) {

    $folder = "../assets/hero/";
    if(!is_dir($folder)) mkdir($folder, 0777, true);

    $filename = time() . "_" . basename($_FILES["image"]["name"]);
    $target = $folder . $filename;

    move_uploaded_file($_FILES["image"]["tmp_name"], $target);

    // Save path that matches index.php
    $image_path = "assets/hero/" . $filename;

    $image_query = ", image='$image_path'";
}

mysqli_query($conn, "UPDATE home_hero SET 
        title='$title',
        subtitle='$subtitle'
        $image_query
        WHERE id=1
");

header("Location: manage-hero.php?success=1");
exit();
?>
