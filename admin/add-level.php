<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit(); 
}

include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $level_name = $_POST['level_name'];
    $slug = strtolower(str_replace(" ", "-", $level_name));

    mysqli_query($conn, 
        "INSERT INTO academic_levels (level_name, slug)
         VALUES ('$level_name', '$slug')"
    );

    header("Location: manage-academics.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Level | Admin</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container" style="margin-top:40px;">
    <h2>Add Academic Level</h2>

    <form method="POST">

        <label>Level Name</label>
        <input type="text" name="level_name" required placeholder="Example: Primary (I–IV)">

        <button class="btn primary" style="margin-top:15px;">Save Level</button>

    </form>
</div>

</body>
</html>
