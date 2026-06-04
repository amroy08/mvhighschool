<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit(); 
}

include "../db.php";

$level_id = $_GET['level_id'];
$level = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM academic_levels WHERE id=$level_id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $grade_name = $_POST['grade_name'];
    $slug = strtolower(str_replace(" ", "-", $grade_name));

    mysqli_query($conn,
        "INSERT INTO academic_grades (level_id, grade_name, slug)
         VALUES ($level_id, '$grade_name', '$slug')"
    );

    header("Location: manage-academics.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Grade | Admin</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container" style="margin-top:40px;">

    <h2>Add Grade to: <?= $level['level_name'] ?></h2>

    <form method="POST">

        <label>Grade Name</label>
        <input type="text" name="grade_name" required placeholder="Example: Grade I">

        <button class="btn primary" style="margin-top:15px;">Save Grade</button>

    </form>

</div>

</body>
</html>
