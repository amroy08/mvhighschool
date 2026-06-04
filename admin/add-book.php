<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit(); 
}

include "../db.php";

$grade_id = $_GET['grade_id'];
$grade = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM academic_grades WHERE id=$grade_id"));
$level = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM academic_levels WHERE id=".$grade['level_id']));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $subject = $_POST['subject'];
    $book_name = $_POST['book_name'];
    $publisher = $_POST['publisher'];

    mysqli_query($conn,
        "INSERT INTO academic_books (grade_id, subject, book_name, publisher)
         VALUES ($grade_id, '$subject', '$book_name', '$publisher')"
    );

    header("Location: manage-academics.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Book | Admin</title>
<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">
<h2>Add Book — <?= $grade['grade_name'] ?> (<?= $level['level_name'] ?>)</h2>

<form method="POST">

<label>Subject</label>
<input type="text" name="subject" required>

<label>Book Name</label>
<input type="text" name="book_name" required>

<label>Publisher</label>
<input type="text" name="publisher" required>

<button class="btn primary" style="margin-top:15px;">Save Book</button>

</form>

</div>

</body>
</html>
