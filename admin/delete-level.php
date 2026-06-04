<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../db.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM academic_levels WHERE id=$id");

header("Location: manage-academics.php");
?>
