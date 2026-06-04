<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

$id = $_GET['id'];

// Fetch existing data
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_sections WHERE id=$id"));

if (!$data) {
    die("Invalid Section ID");
}

$message = "";

// Handle form submission
if (isset($_POST['update'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $updated_at = date("Y-m-d H:i:s");

    $imageName = $data['image'];  // default old image

    // Folder path
    $folder = "../assets/about_sections/";

    // Auto-create folder if missing
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    // Upload new image if selected
    if (!empty($_FILES['image']['name'])) {

        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $ext = pathinfo($img, PATHINFO_EXTENSION);
        $newName = "about_" . time() . "." . $ext;

        move_uploaded_file($tmp, $folder . $newName);

        $imageName = $newName;
    }

    // Update query
    mysqli_query($conn,
        "UPDATE about_sections SET
        name='$name',
        designation='$designation',
        description='$description',
        image='$imageName',
        updated_at='$updated_at'
        WHERE id=$id"
    );

    header("Location: manage-about-sections.php?updated=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Section</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>

<?php include "../header.php"; ?>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<div class="container mt-40">

    <h2 class="text-center">Edit <?= ucfirst(str_replace("_"," ", $data['section'])) ?></h2>

    <form method="post" enctype="multipart/form-data" class="mt-20">

        <label>Name</label>
        <input type="text" name="name" value="<?= $data['name'] ?>" required>

        <label>Designation</label>
        <input type="text" name="designation" value="<?= $data['designation'] ?>" required>

        <label>Description</label>
        <textarea name="description" rows="5" required><?= $data['description'] ?></textarea>

        <label>Current Image</label><br>
        <img src="../assets/about_sections/<?= $data['image'] ?>" width="130" style="border-radius:12px;margin-bottom:15px;">

        <label>Upload New Image (optional)</label>
        <input type="file" name="image">

        <button type="submit" name="update" class="btn primary mt-20">Update</button>

    </form>

</div>

</body>
</html>
