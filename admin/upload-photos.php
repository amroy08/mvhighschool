<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit(); 
}

include "../db.php";

$album_id = intval($_GET['id']);
$album = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM gallery_albums WHERE id=$album_id"));

if (!$album) die("Album not found");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    foreach ($_FILES['photos']['name'] as $i => $name) {

        if ($_FILES['photos']['error'][$i] === 0) {

            // SAVE INSIDE assets/gallery/
            $newName = time() . "-" . basename($name);
            $path = "assets/gallery/" . $newName;   // relative path saved in DB

            // Move file into ../assets/gallery/
            move_uploaded_file(
                $_FILES['photos']['tmp_name'][$i],
                "../" . $path
            );

            // Insert into DB
            mysqli_query($conn,
                "INSERT INTO gallery_photos (album_id, photo_path)
                 VALUES ($album_id, '$path')"
            );
        }
    }

    header("Location: upload-photos.php?id=$album_id");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Upload Photos | Admin</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">
    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<h2>Upload Photos to Album: <?= $album['album_name'] ?></h2>

<form method="POST" enctype="multipart/form-data">
    <label>Select Photos (Multiple Allowed)</label>
    <input type="file" name="photos[]" accept="image/*" multiple required>
    <button class="btn primary" style="margin-top:10px;">Upload</button>
</form>

<hr>

<h3>Existing Photos</h3>

<div style="display:grid;
            grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
            gap:20px;">

<?php
$photos = mysqli_query($conn, 
    "SELECT * FROM gallery_photos WHERE album_id=$album_id"
);

while ($p = mysqli_fetch_assoc($photos)) {

    // Correct full path to display
    $fullPath = "../" . $p['photo_path'];

    echo "
    <div style='text-align:center;'>
        <img src='$fullPath' style='width:100%;border-radius:8px;'>
        <br>
        <a class='btn' 
           style='background:#dc2626;color:white;margin-top:6px;'
           href='delete-photo.php?id={$p['id']}&album=$album_id'
           onclick=\"return confirm('Delete this photo?')\">
           Delete
        </a>
    </div>
    ";
}
?>

</div>

</div>
</body>
</html>
