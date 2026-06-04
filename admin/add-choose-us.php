<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }

include "../db.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $desc = $_POST['description'];

    mysqli_query($conn, "INSERT INTO choose_us (icon, title, description)
    VALUES ('$icon', '$title', '$desc')");

    header("Location: manage-choose-us.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Choose Us</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>
<body>
<div class="container">

<h2>Add New Why Choose Us Point</h2>

<form method="POST">

<label>Icon (FontAwesome class or image path):</label>
<input type="text" name="icon" placeholder="fa-users" required>

<label>Title:</label>
<input type="text" name="title" required>

<label>Description:</label>
<textarea name="description" rows="3" required></textarea>

<button class="btn primary">Add</button>
</form>

</div>
</body>
</html>
