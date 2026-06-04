<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
include "../db.php";

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM news_events WHERE id=$id");
$data = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD']=="POST") {

  $title = $_POST['title'];
  $slug = $_POST['slug'];
  $date = $_POST['event_date'];
  $location = $_POST['location'];
  $status = $_POST['status'];
  $description = $_POST['description'];

  mysqli_query($conn,
    "UPDATE news_events SET
      title='$title',
      slug='$slug',
      event_date='$date',
      location='$location',
      status='$status',
      description='$description'
     WHERE id=$id"
  );

  header("Location: manage-news.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit News | Admin</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">
<h2>Edit News</h2>

<form method="POST">
<label>Title</label>
<input type="text" name="title" value="<?= $data['title'] ?>" required>

<label>Slug</label>
<input type="text" name="slug" value="<?= $data['slug'] ?>" required>

<label>Date</label>
<input type="date" name="event_date" value="<?= $data['event_date'] ?>" required>

<label>Location</label>
<input type="text" name="location" value="<?= $data['location'] ?>" required>

<label>Status</label>
<select name="status">
  <option <?= $data['status']=="Upcoming"?"selected":"" ?>>Upcoming</option>
  <option <?= $data['status']=="Hot"?"selected":"" ?>>Hot</option>
  <option <?= $data['status']=="Completed"?"selected":"" ?>>Completed</option>
  <option <?= $data['status']=="Important"?"selected":"" ?>>Important</option>
  <option <?= $data['status']=="Success"?"selected":"" ?>>Success</option>
</select>

<label>Description</label>
<textarea name="description" rows="6" required><?= $data['description'] ?></textarea>

<button class="btn primary">Update</button>

</form>
</div>

</body>
</html>
