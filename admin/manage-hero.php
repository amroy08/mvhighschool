<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit();
}

include "../db.php";

$hero = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM home_hero WHERE id=1"));
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Home Hero | Admin</title>
<link rel="stylesheet" href="../styles.css">

<style>
.form-card {
  background:#fff;
  padding:25px;
  border-radius:16px;
  box-shadow:0 5px 15px rgba(0,0,0,0.08);
  max-width:800px;
  margin:auto;
  margin-top:40px;
}

input, textarea {
  width:100%;
  padding:10px;
  margin-top:10px;
  border-radius:10px;
  border:1px solid #cbd5e1;
}

label {
  font-weight:600;
  margin-top:15px;
  display:block;
}

.save-btn {
  background:#2563eb;
  color:#fff;
  padding:12px 20px;
  border-radius:10px;
  border:none;
  margin-top:20px;
  cursor:pointer;
}
.save-btn:hover {
  background:#1e40af;
}
</style>
</head>
<body>

<div class="container">

<h2>Manage Home Page Hero Section</h2>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>


<div class="form-card">

<form action="update-hero.php" method="POST" enctype="multipart/form-data">

    <label>Title</label>
    <input type="text" name="title" value="<?= $hero['title'] ?>">

    <label>Subtitle</label>
    <textarea name="subtitle" rows="3"><?= $hero['subtitle'] ?></textarea>

    <label>Current Hero Image</label>
    <img src="../<?= $hero['image'] ?>" 
         style="width:100%;max-width:350px;border-radius:10px;margin-top:10px;">

    <label>Upload New Image</label>
    <input type="file" name="image">

    <button type="submit" class="save-btn">Save Changes</button>

</form>

</div>

</div>

</body>
</html>
