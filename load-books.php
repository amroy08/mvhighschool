<?php
include "db.php";

$grade_id = $_GET['grade_id'];

$res = mysqli_query($conn, "SELECT * FROM academic_books WHERE grade_id=$grade_id ORDER BY id ASC");

$books = [];
while ($b = mysqli_fetch_assoc($res)) {
    $books[] = $b;
}

echo json_encode($books);
?>
