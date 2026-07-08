<?php
include "db.php";

$grade_id = isset($_GET['grade_id']) ? (int)$_GET['grade_id'] : 0;

$books = [];
if ($grade_id > 0 && isset($conn) && $conn) {
    $res = mysqli_query($conn, "SELECT * FROM academic_books WHERE grade_id=$grade_id ORDER BY id ASC");
    if ($res) {
        while ($b = mysqli_fetch_assoc($res)) {
            $books[] = $b;
        }
    }
}

echo json_encode($books);
?>
