<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }

include "../db.php";

$mission = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM about_mission_vision WHERE type='mission'"));
$vision = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM about_mission_vision WHERE type='vision'"));
$values = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM about_mission_vision WHERE type='values'"));
?>
<!DOCTYPE html>
<html>
<head>
<title>Mission & Vision</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>

<body>
<div class="container" style="margin-top:40px;">

<h2>Mission, Vision & Values</h2>

<div class="section-box">
<h3>Mission</h3>
<p><?= substr($mission['content'],0,60) ?>...</p>
<a href="edit-mission.php" class="btn primary">Edit</a>
</div>

<div class="section-box">
<h3>Vision</h3>
<p><?= substr($vision['content'],0,60) ?>...</p>
<a href="edit-vision.php" class="btn primary">Edit</a>
</div>

<div class="section-box">
<h3>Core Values</h3>
<p><?= substr($values['content'],0,60) ?>...</p>
<a href="edit-values.php" class="btn primary">Edit</a>
</div>

</div>
</body>
</html>
