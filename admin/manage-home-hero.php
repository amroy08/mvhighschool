<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: login.php"); exit(); }

include "../db.php";

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM home_hero WHERE id=1"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];

    // Handle image
    $image = $data['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = "uploads/" . time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../" . $image);
    }

    mysqli_query($conn, "UPDATE home_hero SET 
        title='$title', 
        subtitle='$subtitle', 
        image='$image'
        WHERE id=1");

    $success = "Home Hero Updated!";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Home Hero</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>
<div class="container">
<h2>Manage Home Hero</h2>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>


<?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>

<form method="POST" enctype="multipart/form-data">

<label>Title:</label>
<input type="text" name="title" value="<?= $data['title'] ?>" required>

<label>Subtitle:</label>
<textarea name="subtitle" rows="3" required><?= $data['subtitle'] ?></textarea>

<label>Image:</label>
<input type="file" name="image">

<p>Current Image:</p>
<img src="../<?= $data['image'] ?>" width="200" style="border-radius:10px;">

<button class="btn primary">Update</button>
</form>
</div>
</body>
</html>
