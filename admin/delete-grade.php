<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

$id = $_GET['id'];

// Delete grade (all books auto-delete due to CASCADE)
mysqli_query($conn, "DELETE FROM academic_grades WHERE id=$id");

header("Location: manage-academics.php");
?>
