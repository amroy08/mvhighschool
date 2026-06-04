<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

$id = $_GET['id'];
$book = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM academic_books WHERE id=$id"));
$grade = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM academic_grades WHERE id=".$book['grade_id']));
$level = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM academic_levels WHERE id=".$grade['level_id']));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $subject = $_POST['subject'];
    $book_name = $_POST['book_name'];
    $publisher = $_POST['publisher'];

    mysqli_query($conn,
        "UPDATE academic_books SET
         subject='$subject',
         book_name='$book_name',
         publisher='$publisher'
         WHERE id=$id"
    );

    header("Location: manage-academics.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Book | Admin</title>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="container" style="margin-top:40px;">

<h2>Edit Book — <?= $grade['grade_name'] ?> (<?= $level['level_name'] ?>)</h2>

<form method="POST">

<label>Subject</label>
<input type="text" name="subject" value="<?= $book['subject'] ?>" required>

<label>Book Name</label>
<input type="text" name="book_name" value="<?= $book['book_name'] ?>" required>

<label>Publisher</label>
<input type="text" name="publisher" value="<?= $book['publisher'] ?>" required>

<button class="btn primary" style="margin-top:15px;">Update</button>

</form>

</div>

</body>
</html>
