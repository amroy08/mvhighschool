<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }

include "../db.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_sections WHERE id=$id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $data['image'];

    // If image uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "-" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/" . $image);
    }

    mysqli_query($conn,
      "UPDATE about_sections 
       SET name='$name', description='$description', image='$image'
       WHERE id=$id"
    );

    header("Location: manage-about.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit About Section</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>
    
    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<div class="container" style="margin-top:40px;">
<h2>Edit <?= ucfirst(str_replace("_", " ", $data['section'])) ?></h2>

<form method="POST" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name" value="<?= $data['name'] ?>" required>

<label>Description</label>
<textarea name="description" rows="5" required><?= $data['description'] ?></textarea>

<label>Image</label><br>
<img src="../assets/<?= $data['image'] ?>" width="120" style="border-radius:10px;margin-bottom:10px;"><br>
<input type="file" name="image">

<button class="btn primary" style="margin-top:15px;">Save Changes</button>

</form>
</div>

</body>
</html>
