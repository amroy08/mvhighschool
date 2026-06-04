<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ 
    header("Location: login.php"); 
    exit(); 
}

include "../db.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    // Escape special characters to prevent SQL errors
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Image Upload
    $image = time() . "-" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/" . $image);

    // Insert Query
    $sql = "INSERT INTO about_founder_slider (title, message, image) 
            VALUES ('$title', '$message', '$image')";
    
    mysqli_query($conn, $sql) or die("SQL ERROR: " . mysqli_error($conn));

    header("Location: manage-founder-slider.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Slide</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<div class="container" style="margin-top:40px;">
<h2>Add Founder Message Slide</h2>

<form method="POST" enctype="multipart/form-data">

<label>Title</label>
<input type="text" name="title" required>

<label>Message</label>
<textarea name="message" required></textarea>

<label>Image</label>
<input type="file" name="image" required>

<button class="btn primary" style="margin-top:15px;">Save</button>

</form>
</div>
</body>
</html>
