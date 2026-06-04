<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

$id = $_GET['id'];
$level = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM academic_levels WHERE id=$id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $level_name = $_POST['level_name'];
    $slug = strtolower(str_replace(" ", "-", $level_name));

    mysqli_query($conn,
        "UPDATE academic_levels SET 
         level_name='$level_name', 
         slug='$slug'
         WHERE id=$id"
    );

    header("Location: manage-academics.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Level | Admin</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container" style="margin-top:40px;">
    <h2>Edit Level</h2>

    <form method="POST">

        <label>Level Name</label>
        <input type="text" name="level_name" value="<?= $level['level_name'] ?>" required>

        <button class="btn primary" style="margin-top:15px;">Update</button>

    </form>
</div>

</body>
</html>
