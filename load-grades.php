<?php
include "db.php";

$level_id = $_GET['level_id'];

$res = mysqli_query($conn, "SELECT * FROM academic_grades WHERE level_id=$level_id ORDER BY id ASC");

$grades = [];
while ($g = mysqli_fetch_assoc($res)) {
    $grades[] = $g;
}

echo json_encode($grades);
?>
