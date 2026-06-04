<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }
include "../db.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // Use mysqli_real_escape_string to handle single quotes and apostrophes
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $passing_year = mysqli_real_escape_string($conn, $_POST['passing_year']);
    $achievement = mysqli_real_escape_string($conn, $_POST['achievement']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $photo = time()."-".$_FILES["photo"]["name"];
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../assets/".$photo);

    // The query will now handle the special characters correctly
    $query = "INSERT INTO alumni (name, passing_year, achievement, message, photo) 
              VALUES ('$name', '$passing_year', '$achievement', '$message', '$photo')";
    
    if(mysqli_query($conn, $query)){
        header("Location: manage-alumni.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Alumni</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>
<div class="container">
    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
<h2>Add Alumni</h2>

<form method="POST" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name" required>

<label>Passing Year</label>
<input type="text" name="passing_year">

<label>Achievement</label>
<input type="text" name="achievement">

<label>Message / Testimonial</label>
<textarea name="message"></textarea>

<label>Photo</label>
<input type="file" name="photo" required>

<button type="submit" class="btn btn-primary">Save Alumni</button>
</form>

</div>
</body>
</html>
