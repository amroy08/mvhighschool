<?php
include "db.php";

$level_id = isset($_GET['level_id']) ? (int)$_GET['level_id'] : 0;

$grades = [];
if ($level_id > 0 && isset($conn) && $conn) {
    $res = mysqli_query($conn, "SELECT * FROM academic_grades WHERE level_id=$level_id ORDER BY id ASC");
    if ($res) {
        while ($g = mysqli_fetch_assoc($res)) {
            $grades[] = $g;
        }
    }
}

echo json_encode($grades);
?>
