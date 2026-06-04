<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit(); 
}

include "../db.php";

$type = 'vision';
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_mission_vision WHERE type='$type'"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $content = $_POST['content'];

    mysqli_query($conn,
        "UPDATE about_mission_vision SET content='$content'
         WHERE type='$type'"
    );

    header("Location: manage-mission-vision.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Vision</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">
<h2>Edit Vision</h2>

<form method="POST">

<label>Vision Content</label>
<textarea name="content" rows="8" required><?= $data['content'] ?></textarea>

<button class="btn primary" style="margin-top:15px;">Update</button>

</form>

</div>
</body>
</html>
