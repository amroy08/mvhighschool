<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit(); 
}

include "../db.php";

$id = $_GET['id'];
$grade = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM academic_grades WHERE id=$id"));
$level = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM academic_levels WHERE id=".$grade['level_id']));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $grade_name = $_POST['grade_name'];
    $slug = strtolower(str_replace(" ", "-", $grade_name));

    mysqli_query($conn,
        "UPDATE academic_grades SET 
         grade_name='$grade_name',
         slug='$slug'
         WHERE id=$id"
    );

    header("Location: manage-academics.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Grade | Admin</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container" style="margin-top:40px;">

    <h2>Edit Grade (<?= $level['level_name'] ?>)</h2>

    <form method="POST">

        <label>Grade Name</label>
        <input type="text" name="grade_name" value="<?= $grade['grade_name'] ?>" required>

        <button class="btn primary" style="margin-top:15px;">Update Grade</button>

    </form>

</div>

</body>
</html>
